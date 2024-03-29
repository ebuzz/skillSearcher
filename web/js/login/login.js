$(function() {

  $('.form').find('input, textarea').on('keyup blur focus', function (e) {
    
    var $this = $(this),
        label = $this.prev('label');

      if (e.type === 'keypress') {
        if ($this.val() === '') {
            label.removeClass('active highlight');
          } else {
            label.addClass('active highlight');
          }
      } else if (e.type === 'blur') {
        if( $this.val() === '' ) {
          label.removeClass('active highlight'); 
        } else {
          label.removeClass('highlight');   
        }   
      } else if (e.type === 'focus') {
        
        if( $this.val() === '' ) {
          label.addClass('active')
          label.removeClass('highlight'); 
        } 
        else if( $this.val() !== '' ) {
          label.addClass('active')
          label.addClass('highlight');
        }
      }

  });

  $('.tab a').on('click', function (e) {
    
    e.preventDefault();
    
    $(this).parent().addClass('active');
    $(this).parent().siblings().removeClass('active');
    
    target = $(this).attr('href');

    $('.tab-content > div').not(target).hide();
    
    $(target).fadeIn(600);
    
  });

  var showPass = $('.form-control-feedback');
  showPass.click(function(){
    var clicks = $(this).data('clicks');
    console.log(clicks);
     if (clicks) {
      $(this).prev('input').prop('type','text');
    } else{
      $(this).prev('input').prop('type','password');
    }
    $(this).data("clicks", !clicks);
  });
});