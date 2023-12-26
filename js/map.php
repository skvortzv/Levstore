<script>
var map;

DG.then(function () {
    map = DG.map('map', {
        center: [<?php print($lat); ?>, <?php print($lon); ?>],
        zoom: 13
    });

    DG.marker([<?php print($lat); ?>, <?php print($lon); ?>]).addTo(map);
});
</script>