<?php
session_start();
session_destroy();
@unlink('sesi_web.json');
echo "✅ Anda telah keluar. <a href='index.php'>Masuk lagi</a>";
