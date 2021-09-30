const initCourseAccordion = function(){
    jQuery(".study-your-diploma").insertAfter('.mentoring-program');
  const accordions = document.querySelectorAll('.course-accordion-item');
    accordions.forEach( accordion => {
      accordion.querySelector('.course-accordion-toggle').addEventListener('click', () => {
          accordion.classList.toggle('active');
        });
    });
};
initCourseAccordion();

const initFaqAccordian = () =>{
  const faqAccordian =  document.querySelectorAll('.faq-accordian .faq-item');
  faqAccordian.forEach( fagItem => {
      fagItem.addEventListener('click', () => {
          fagItem.classList.toggle('active');
        });
    });
};
initFaqAccordian();


const ctaOnScroll = function(){
  if(!document.querySelector('.single-course')){return;}
  
  window.addEventListener('scroll', function(){
    let popBtnTop = document.querySelector('.course-content.bottom').offsetTop + 200,
        formBottom = document.querySelector('.course-sidebar').offsetTop,
        mobileCta = document.querySelector('.single-course .mobile-cta');
    
    if (this.scrollY >= popBtnTop) {
      mobileCta.classList.add('on');
    }else{
      mobileCta.classList.remove('on');
    }
    
    if(this.scrollY >= formBottom) {
      mobileCta.classList.remove('on');
    }
    
  });
};
ctaOnScroll();

const ctaLink = function(){
  if(!document.querySelector('.cta-link')){return;}
  
  const requestBtn =  document.querySelector('.cta-link.btn');
  requestBtn.addEventListener('click', function(e){
    if(window.innerWidth <= 767){
      e.preventDefault();
      let formFrame = document.querySelector('#course-form'),
          formFrameTopPos = formFrame.getBoundingClientRect().top;

      formFrame.classList.add('onfocus');
      window.scrollTo({ top:formFrameTopPos, left:0, behavior: 'smooth' });
    }
  });
};
ctaLink();





          


