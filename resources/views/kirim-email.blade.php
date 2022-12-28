<!DOCTYPE html>
<html>
<head>
    <title>FBN</title>
</head>
<!-- implode untuk mengubah tipe data array menjadi string -->
<body>
    <p>Kepada Yth. <b>{{ implode(", ",$details['nama']) }}</b>,</p>
    <p>Berikut kami kirimkan link untuk generate PDF yang dapat Anda ubah : {{ $details['link'] }}</p>
   
    <p>Thank you</p>
</body>
</html>