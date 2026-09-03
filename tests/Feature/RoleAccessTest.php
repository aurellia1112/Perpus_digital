<?php

namespace Tests\Feature;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_login_redirects_to_admin_dashboard(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => $admin->email,
            'password' => 'password123',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('admin.dashboard', absolute: false));
    }

    public function test_user_login_redirects_to_user_dashboard(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_user_cannot_access_admin_dashboard(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(403);
    }

    public function test_user_cannot_access_admin_buku(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/admin/buku');

        $response->assertStatus(403);
    }

    public function test_user_cannot_access_admin_user(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/admin/user');

        $response->assertStatus(403);
    }

    public function test_user_cannot_access_admin_peminjaman(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/admin/peminjaman');

        $response->assertStatus(403);
    }

    public function test_admin_cannot_access_user_dashboard(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/dashboard');

        $response->assertStatus(403);
    }

    public function test_admin_can_access_all_admin_routes(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)->get('/admin/dashboard')->assertStatus(200);
        $this->actingAs($admin)->get('/admin/buku')->assertStatus(200);
        $this->actingAs($admin)->get('/admin/user')->assertStatus(200);
        $this->actingAs($admin)->get('/admin/peminjaman')->assertStatus(200);
    }

    public function test_user_only_sees_own_borrowing_history(): void
    {
        $userA = User::factory()->create(['name' => 'Siswa A', 'role' => 'user']);
        $userB = User::factory()->create(['name' => 'Siswa B', 'role' => 'user']);

        $buku1 = Buku::create([
            'kode_buku' => 'BK-001',
            'judul' => 'Buku Siswa A',
            'pengarang' => 'Penulis A',
            'penerbit' => 'Penerbit A',
            'stok' => 5,
        ]);

        $buku2 = Buku::create([
            'kode_buku' => 'BK-002',
            'judul' => 'Buku Siswa B Rahasia',
            'pengarang' => 'Penulis B',
            'penerbit' => 'Penerbit B',
            'stok' => 5,
        ]);

        Peminjaman::create([
            'user_id' => $userA->id,
            'buku_id' => $buku1->id,
            'tanggal_pinjam' => now()->toDateString(),
            'tanggal_kembali' => now()->addDays(7)->toDateString(),
            'status' => 'dipinjam',
        ]);

        Peminjaman::create([
            'user_id' => $userB->id,
            'buku_id' => $buku2->id,
            'tanggal_pinjam' => now()->toDateString(),
            'tanggal_kembali' => now()->addDays(7)->toDateString(),
            'status' => 'dipinjam',
        ]);

        $responseA = $this->actingAs($userA)->get('/dashboard');
        $responseA->assertStatus(200);
        $responseA->assertSee('Buku Siswa A');

        $riwayatA = $responseA->viewData('riwayat');
        $this->assertCount(1, $riwayatA);
        $this->assertEquals($buku1->id, $riwayatA->first()->buku_id);
    }

    public function test_admin_can_manage_books_crud(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        // Create book
        $response = $this->actingAs($admin)->post('/admin/buku', [
            'kode_buku' => 'BK-100',
            'judul' => 'Buku Baru Admin',
            'pengarang' => 'Pengarang Test',
            'penerbit' => 'Penerbit Test',
            'stok' => 10,
        ]);
        $response->assertRedirect(route('admin.buku.index'));
        $this->assertDatabaseHas('bukus', ['kode_buku' => 'BK-100']);

        $buku = Buku::where('kode_buku', 'BK-100')->first();

        // Update book
        $responseUpdate = $this->actingAs($admin)->put("/admin/buku/{$buku->id}", [
            'kode_buku' => 'BK-100',
            'judul' => 'Buku Baru Admin Updated',
            'pengarang' => 'Pengarang Test',
            'penerbit' => 'Penerbit Test',
            'stok' => 12,
        ]);
        $responseUpdate->assertRedirect(route('admin.buku.index'));
        $this->assertDatabaseHas('bukus', ['judul' => 'Buku Baru Admin Updated', 'stok' => 12]);

        // Delete book
        $responseDelete = $this->actingAs($admin)->delete("/admin/buku/{$buku->id}");
        $responseDelete->assertRedirect(route('admin.buku.index'));
        $this->assertDatabaseMissing('bukus', ['id' => $buku->id]);
    }

    public function test_admin_can_manage_users_crud(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        // Create member
        $response = $this->actingAs($admin)->post('/admin/user', [
            'name' => 'Siswa Baru',
            'email' => 'siswabaru@test.com',
            'password' => 'password123',
            'role' => 'user',
        ]);
        $response->assertRedirect(route('admin.user.index'));
        $this->assertDatabaseHas('users', ['email' => 'siswabaru@test.com', 'role' => 'user']);

        $newUser = User::where('email', 'siswabaru@test.com')->first();

        // Update member
        $responseUpdate = $this->actingAs($admin)->put("/admin/user/{$newUser->id}", [
            'name' => 'Siswa Baru Updated',
            'email' => 'siswabaru@test.com',
            'role' => 'user',
        ]);
        $responseUpdate->assertRedirect(route('admin.user.index'));
        $this->assertDatabaseHas('users', ['name' => 'Siswa Baru Updated']);

        // Delete member
        $responseDelete = $this->actingAs($admin)->delete("/admin/user/{$newUser->id}");
        $responseDelete->assertRedirect(route('admin.user.index'));
        $this->assertDatabaseMissing('users', ['id' => $newUser->id]);
    }

    public function test_admin_can_manage_loans_and_return(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'user']);
        $buku = Buku::create([
            'kode_buku' => 'BK-555',
            'judul' => 'Buku Peminjaman',
            'pengarang' => 'Pengarang',
            'penerbit' => 'Penerbit',
            'stok' => 5,
        ]);

        // Create loan
        $response = $this->actingAs($admin)->post('/admin/peminjaman', [
            'user_id' => $user->id,
            'buku_id' => $buku->id,
            'tanggal_pinjam' => now()->toDateString(),
            'tanggal_kembali' => now()->addDays(5)->toDateString(),
        ]);
        $response->assertRedirect(route('admin.peminjaman.index'));
        $this->assertEquals(4, $buku->fresh()->stok);

        $peminjaman = Peminjaman::where('buku_id', $buku->id)->first();
        $this->assertEquals('dipinjam', $peminjaman->status);

        // Process return
        $responseReturn = $this->actingAs($admin)->patch("/admin/peminjaman/{$peminjaman->id}/kembali");
        $responseReturn->assertRedirect(route('admin.peminjaman.index'));
        $this->assertEquals('dikembalikan', $peminjaman->fresh()->status);
        $this->assertEquals(5, $buku->fresh()->stok);
    }

    public function test_user_cannot_mutate_admin_resources(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $buku = Buku::create([
            'kode_buku' => 'BK-999',
            'judul' => 'Buku Mutasi',
            'pengarang' => 'Pengarang',
            'penerbit' => 'Penerbit',
            'stok' => 5,
        ]);

        // POST Buku
        $this->actingAs($user)->post('/admin/buku', [
            'kode_buku' => 'BK-888',
            'judul' => 'Buku Hack',
            'pengarang' => 'Pengarang',
            'penerbit' => 'Penerbit',
            'stok' => 1,
        ])->assertStatus(403);

        // PUT Buku
        $this->actingAs($user)->put("/admin/buku/{$buku->id}", [
            'kode_buku' => 'BK-999',
            'judul' => 'Buku Diubah Siswa',
            'pengarang' => 'Pengarang',
            'penerbit' => 'Penerbit',
            'stok' => 10,
        ])->assertStatus(403);

        // DELETE Buku
        $this->actingAs($user)->delete("/admin/buku/{$buku->id}")->assertStatus(403);

        // POST User
        $this->actingAs($user)->post('/admin/user', [
            'name' => 'User Hack',
            'email' => 'hack@hack.com',
            'password' => 'password123',
            'role' => 'admin',
        ])->assertStatus(403);

        // POST Peminjaman
        $this->actingAs($user)->post('/admin/peminjaman', [
            'user_id' => $user->id,
            'buku_id' => $buku->id,
            'tanggal_pinjam' => now()->toDateString(),
            'tanggal_kembali' => now()->addDays(5)->toDateString(),
        ])->assertStatus(403);
    }

    public function test_user_can_borrow_and_return_book_from_user_dashboard(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $buku = Buku::create([
            'kode_buku' => 'BK-777',
            'judul' => 'Buku Siswa Pinjam',
            'pengarang' => 'Pengarang',
            'penerbit' => 'Penerbit',
            'stok' => 3,
        ]);

        // Pinjam buku
        $response = $this->actingAs($user)->post('/dashboard/pinjam', [
            'buku_id' => $buku->id,
            'tanggal_kembali' => now()->addDays(7)->toDateString(),
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertEquals(2, $buku->fresh()->stok);

        $peminjaman = Peminjaman::where('user_id', $user->id)->where('buku_id', $buku->id)->first();
        $this->assertNotNull($peminjaman);
        $this->assertEquals('dipinjam', $peminjaman->status);

        // Pengembalian mandiri
        $responseKembali = $this->actingAs($user)->patch("/dashboard/kembali/{$peminjaman->id}");
        $responseKembali->assertRedirect(route('dashboard'));
        $this->assertEquals('dikembalikan', $peminjaman->fresh()->status);
        $this->assertEquals(3, $buku->fresh()->stok);
    }

    public function test_admin_cannot_borrow_book_via_user_route(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $buku = Buku::create([
            'kode_buku' => 'BK-666',
            'judul' => 'Buku Admin Coba Pinjam',
            'pengarang' => 'Pengarang',
            'penerbit' => 'Penerbit',
            'stok' => 3,
        ]);

        $response = $this->actingAs($admin)->post('/dashboard/pinjam', [
            'buku_id' => $buku->id,
            'tanggal_kembali' => now()->addDays(7)->toDateString(),
        ]);

        $response->assertStatus(403);
        $this->assertEquals(3, $buku->fresh()->stok);
    }
}

