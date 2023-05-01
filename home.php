<img src="img/0.jpg" alt="" id="gambar">
<br>
<br>
<a href="#" onclick="ganti(0)" class="btn-xs btn-biru">1</a>
<a href="#" onclick="ganti(1)" class="btn-xs btn-biru">2</a>
<a href="#" onclick="ganti(2)" class="btn-xs btn-biru">3</a>
<script>
    function ganti(angka){
        var lokasi = 'img/' + angka + '.jpg';
        document.getElementById('gambar').src = lokasi;
        return false;
    }
</script>