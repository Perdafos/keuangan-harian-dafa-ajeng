<!DOCTYPE html>
<html>

<body>
    <h2>Data Transaksi</h2>
    <div id="data"></div>
    <script>
        fetch('http://127.0.0.1:8000/api/transaksi')
            .then(res => res.json())
            .then(res => {
                let html = '';
                res.data.forEach(item => {
                    html += `<p>${item.keterangan} - Rp${item.jumlah}</p>`;
                });
                document.getElementById('data').innerHTML = html;
            });
    </script>
</body>

</html>
