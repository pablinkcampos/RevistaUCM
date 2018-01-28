<!DOCTYPE html>
    <html dir='ltr' lang='es'>
                  

    <head>

        <link rel='stylesheet' href="<?php echo base_url();?>css/sweetalert.css" type='text/css' />
        <script type='text/javascript' src="<?php echo base_url();?>js/sweetalert.min.js"></script>
                </head>
                <body>
                 <script>


        setTimeout(function() {
            swal({
                title: <?php echo json_encode($title, JSON_HEX_TAG); ?>,
                text: <?php echo json_encode($text, JSON_HEX_TAG); ?>,
                type: <?php echo json_encode($tipoaviso, JSON_HEX_TAG); ?>
            }, function() {
                window.location.href = <?php echo json_encode($windowlocation, JSON_HEX_TAG); ?>;
            });
        }, 100);
    </script>
    
  </body></html>