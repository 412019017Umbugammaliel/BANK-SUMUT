Catatan:
Project ini menggunakan lokal server XAMPP.
Dalam project terdapat proses upload file, pada bagian:
  1. Account And Security (Update Foto Profile).
  2. Ticket (Kirim file melalui konsole obrolan).

Untuk mencegah kegagalan atau kesalahan pada saat proses upload file, pada project bagian validasi file sudah diset maximal 200MB.

Pada sisi server XAMPP pada file php.ini, dapat disesuaikan dengan maximal upload file pada project yaiutu 200MB.
  Pengaturan pada php.ini:
    -Pada disk C:\xampp\php\php.ini
    -Ubah ukuran: 	-post_max_size = 200MB,
	        	-upload_max_filesize = 200MB.