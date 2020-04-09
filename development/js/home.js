$('.themanh-main').on({
    beforeChange: function(event, slick, currentSlide, nextSlide) {
        myLazyLoad.update();
    }
}).slick({
    lazyLoad: 'ondemand',
    infinite: true,
    accessibility: false,
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 3000,
    speed: 1000,
    vertical: false,
    arrows: true,
    centerMode: false,
    dots: false,
    draggable: true,
});
$('.dmspnoibat-main').on({
      beforeChange: function(event, slick, currentSlide, nextSlide) {
          myLazyLoad.update();
      }
  }).slick({
      lazyLoad: 'ondemand',
      infinite: true,
      accessibility: false,
      slidesToShow: 7,
      slidesToScroll: 1,
      autoplay: true,
      vertical: true,
      autoplaySpeed: 3000,
      speed: 1000,
      arrows: true,
      centerMode: false,
      dots: false,
      draggable: true,
      responsive: [{
          breakpoint: 800,
          settings: {
              slidesToShow: 3,
          }
      }, {
          breakpoint: 430,
          settings: {
              slidesToShow: 1
          }
      }, {
          breakpoint: 330,
          settings: {
              slidesToShow: 1
          }
      }]
  });
  $('.doitac-main').on({
        beforeChange: function(event, slick, currentSlide, nextSlide) {
            myLazyLoad.update();
        }
    }).slick({
        lazyLoad: 'ondemand',
        infinite: true,
        accessibility: false,
        slidesToShow: 8,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        speed: 1000,
        arrows: true,
        centerMode: false,
        dots: false,
        draggable: true,
        responsive: [{
            breakpoint: 800,
            settings: {
                slidesToShow: 3,
            }
        }, {
            breakpoint: 430,
            settings: {
                slidesToShow: 1
            }
        }, {
            breakpoint: 330,
            settings: {
                slidesToShow: 1
            }
        }]
    });
  
  $('.tinnb-main').on({
      beforeChange: function(event, slick, currentSlide, nextSlide) {
          myLazyLoad.update();
      }
  }).slick({
     lazyLoad: 'ondemand',
           infinite: true,
           accessibility: false,
           slidesToShow: 2,
           slidesToScroll: 1,
           vertical: false,
           autoplay: true,
           autoplaySpeed: 3000,
           speed: 1000,
           arrows: true,
           centerMode: false,
           dots: false,
           draggable: true,
  });