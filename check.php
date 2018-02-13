<?php

echo "<script>$(function () {

    var tabId = window.location.hash;

    $('#nav nav-tabs').find('a[href=' + tabId + ']').tab('show');

})
</script>";
?>