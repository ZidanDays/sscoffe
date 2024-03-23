<?php
// Mulai session
session_start();

// Hapus semua data session
session_destroy();

// Redirect ke halaman login atau halaman lain yang sesuai
header("Location: ../");
exit; // Pastikan tidak ada output lain sebelum redirect