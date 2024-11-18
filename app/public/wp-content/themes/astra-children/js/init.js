
function isMobile() {
  return window.innerWidth < 768; 
}


function init() {
  if(isMobile()) return false;

    gsap.registerPlugin(ScrollTrigger);

  
    gsap.from(".container", {
      opacity: 0,
      x: (i) => (i % 2 === 0 ? -200 : 200),
      duration: 1.2,
      stagger: 0.3,
      ease: "power2.out",
      scrollTrigger: {
        trigger: ".timeline",
        start: "top 80%",
        end: "bottom 20%",
        scrub: true,
      }
    });
    

    gsap.from(".container .content", {
      opacity: 0,
      y: 50, 
      duration: 1.2,
      stagger: 0.3,
      ease: "power3.out",
      scrollTrigger: {
        trigger: ".timeline",
        start: "top 80%",
        end: "bottom 20%",
        scrub: true,
      }
    });
    
    
    gsap.from(".year", {
      opacity: 0,
      scale: 0.9,
      duration: 1,
      stagger: 0.3,
      ease: "power2.out",
      scrollTrigger: {
        trigger: ".timeline",
        start: "top 70%",
        end: "bottom 30%",
        scrub: true,
      }
    });
    
    gsap.from(".description", {
      opacity: 0,
      y: 40,
      duration: 1.2,
      stagger: 0.3,
      ease: "power3.out",
      scrollTrigger: {
        trigger: ".timeline",
        start: "top 70%",
        end: "bottom 30%",
        scrub: true,
      }
    });
    
    gsap.fromTo(".icon-box", {
        opacity: 0,  
    }, {
        opacity: 1,  
        stagger: 0.2,  
        duration: 1,  
        ease: "power2.out",
        delay: 0.5  
    });

    gsap.from(".hero_banner_animation", {
        x: "-100%",      
        opacity: 0,      
        ease: "bounce.out", 
        duration: 1.5   
       
    });

    gsap.from(".h2_animation", {
        y: 50,             
        opacity: 0,        
        ease: "bounce.out", 
        duration: 1,       
        scrollTrigger: {
            trigger: ".h2_animation", 
            start: "top 80%",   
            end: "top 30%",     
            toggleActions: "play none none none", 
            once: true          
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
  const loadMoreButton = document.getElementById('load_more');
  
  if (loadMoreButton) {
    loadMoreButton.addEventListener('click', function() {
      let page = parseInt(loadMoreButton.dataset.page);
      let nextPage = page + 1;
      loadMoreButton.textContent = 'Loading...';

      // Make AJAX request using Fetch API
      fetch(ajaxurl + '?action=load_more_projects&page=' + nextPage)
        .then(response => response.text())
        .then(data => {
          if (data.trim() !== '') {
            // Append the new projects to the existing list
            document.querySelector('.projets-web').insertAdjacentHTML('beforeend', data);
            loadMoreButton.dataset.page = nextPage; // Update the page number
            loadMoreButton.textContent = 'Load More';
          } else {
            loadMoreButton.textContent = 'No More Projects';
          }
        })
        .catch(error => {
          console.error('Error:', error);
          loadMoreButton.textContent = 'Error loading more projects';
        });
    });
  }
});

document.addEventListener('DOMContentLoaded', function() {
  const filterForm = document.getElementById('projets-filter-form');
  
  if (filterForm) {
    filterForm.addEventListener('submit', function(e) {
      e.preventDefault();

      const language = document.getElementById('language-filter').value;
      const container = document.getElementById('projets-web-container');

      // Show a loading message while fetching
      container.innerHTML = 'Loading...';

      fetch(ajaxurl + '?action=filter_projects_by_language&language=' + encodeURIComponent(language))
        .then(response => response.text())
        .then(data => {
          container.innerHTML = data;
        })
        .catch(error => {
          console.error('Error:', error);
          container.innerHTML = 'Error loading filtered projects';
        });
    });
  }
});





document.addEventListener('DOMContentLoaded',init);
