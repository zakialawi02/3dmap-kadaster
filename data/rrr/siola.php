<div class="rrr" id="rrr"></div>
<script>
    function getRRRrusunawa(data) {
        fetch(data)
            .then(response => {
                // Memastikan response dalam bentuk teks
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                console.log("success");
                // Menampilkan data di dalam div dengan id dataContainer
                document.getElementById('rrr').innerHTML = data;
            })
            .catch(error => {
                console.error('There has been a problem with your fetch operation:', error);
            });
    }

    getRRRrusunawa("/data/rrr/rusunawa.php")
</script>