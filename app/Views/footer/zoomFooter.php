    <script>
        var img = document.createElement('img');
        img.src = '<?php echo base_url('public/assets/images/'.getwebsiteSetting('st_logo'))?>';
        img.className = 'custom-img';
        document.body.appendChild(img);
    </script>
</body>
</html>