
//Validate Form
$('.validate-form').validationEngine();

//Regular Delete Confirmation
$('.delete-confirm').on('click',function(e){
  e.preventDefault();

  var currentElement = $(this);
  
  swal({
        title: "Are you sure?",
        /*text: "Please confirm your action",*/
        icon: "warning",
        buttons: {
          cancel: {
              text: "No, cancel Please!",
              value: null,
              visible: true,
              className: "btn-primary",              
          },
          confirm: {
              text: "Yes, delete it!",
              value: true,
              visible: true,
              className: "btn-danger",
              closeModal: false
          }
        }
    }).then(isConfirm => {
        if (isConfirm) {
            currentElement.parents('form').submit();
        } else {
            swal("Cancelled", "It's safe.", "error");
        }
    });
});

//Radio Checkbox
$('.skin-polaris input').iCheck({
    checkboxClass: 'icheckbox_polaris',
    radioClass: 'iradio_polaris',
    increaseArea: '-10%'
});

$('.skin-futurico input').iCheck({
    checkboxClass: 'icheckbox_futurico',
    radioClass: 'iradio_futurico',
    increaseArea: '20%'
});

$('.skin-flat input').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
});