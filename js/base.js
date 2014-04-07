var $sp, $cp,
    $layout;
    
$(document).ready(function(){
    var $btnSP = $("#btnSP");
    var $btnCP = $("#btnCP");
    var $msg = $("#msg");
    $layout = $("#layout");
    $sp = $("#formSP");
    $cp = $("#formCP");
    
    var fSP = $sp.bind("invalid-form.validate",
        function() {
            $msg.html("Debe completar todos los campos obligatorios (*)");
        }).validate({
        rules: {},
        errorPlacement: function(error, element) {
            var $e = $(element),
                $pa = $e.parent();
            while(!$pa.hasClass("control-group")) {
                $pa = $pa.parent();
            }
            if($e.hasClass("error")) {
                $pa.addClass("error");
            } else {
                $pa.removeClass("error");
            }
        },
        submitHandler: function(form) {
            if(!$btnSP.hasClass("disabled")) {
                $btnSP.addClass("disabled");
                $.ajax({
                    url: form.action,
                    type: "post",
                    dataType: "json",
                    data: $(form).serializeArray(),
                    beforeSend: function() {
                        $btnSP.val("Generando Layout");
                    },
                    success: function(data) {
                        $layout.html("<img src='"+data.src+"' />");
                        $btnSP.removeClass("disabled");
                        $btnSP.val("Generar Layout");
                    }
                });
            }
            return false;
        },
        success: function(label) {
        }
    });
    
    var fCP = $cp.bind("invalid-form.validate",
        function() {
            $msg.html("Debe completar todos los campos obligatorios (*)");
        }).validate({
        rules: {},
        errorPlacement: function(error, element) {
            var $e = $(element),
                $pa = $e.parent();
            while(!$pa.hasClass("control-group")) {
                $pa = $pa.parent();
            }
            if($e.hasClass("error")) {
                $pa.addClass("error");
            } else {
                $pa.removeClass("error");
            }
        },
        submitHandler: function(form) {
            if(!$btnCP.hasClass("disabled")) {
                $btnCP.addClass("disabled");
                $.ajax({
                    url: form.action,
                    type: "post",
                    dataType: "json",
                    data: $(form).serializeArray(),
                    beforeSend: function() {
                        $btnCP.val("Generando Layout");
                    },
                    success: function(data) {
                        if(data.error == 0) {
                            $layout.html("<img src='"+data.src+"' />");
                        } else {
                            $layout.html("<p class='watermark'>"+data.msg+"</p>");
                        }
                        $btnCP.removeClass("disabled");
                        $btnCP.val("Generar Layout");
                    }
                });
            }
            return false;
        },
        success: function(label) {
        }
    });
});