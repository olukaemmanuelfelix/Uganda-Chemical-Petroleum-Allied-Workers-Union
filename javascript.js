//toggling navigation
const toggleBtn = document.querySelector('.MenueToggle');
const dropdownMenu = document.querySelector('.dropdown_menu');
const navLinks = document.querySelectorAll('.dropdown_menu a');

toggleBtn.addEventListener('click', function () {
    dropdownMenu.classList.toggle('open');
});

navLinks.forEach((link) => {
    link.addEventListener('click', function (event) {
        // Close the dropdown menu after a short delay
        setTimeout(() => {
            dropdownMenu.classList.remove('open');
        }, 100);
    });
});


//toggling disgital marketing
document.getElementById('btn').addEventListener('click', function(){
    var list = document.getElementById('items');
    list.style.display = (list.style.display === 'none')
    ? 'block'
    : 'none'; 
});

//toggling software installation
document.getElementById('bt').addEventListener('click', function(){
    var list = document.getElementById('tems');
    list.style.display = (list.style.display === 'none')
    ? 'block'
    : 'none'; 
});

//toggling web design and development
document.getElementById('bt_web').addEventListener('click', function(){
    var list = document.getElementById('item_web');
    list.style.display = (list.style.display === 'none')
    ? 'block'
    : 'none'; 
});

//toggling graphics design
document.getElementById('bt_graphics').addEventListener('click', function(){
    var list = document.getElementById('item_graphics');
    list.style.display = (list.style.display === 'none')
    ? 'block'
    : 'none'; 
});

//toggling app design
document.getElementById('bt_app').addEventListener('click', function(){
    var list = document.getElementById('item_app');
    list.style.display = (list.style.display === 'none')
    ? 'block'
    : 'none'; 
});

//toggling app design
document.getElementById('bt_lessons').addEventListener('click', function(){
    var list = document.getElementById('item_lessons');
    list.style.display = (list.style.display === 'none')
    ? 'block'
    : 'none'; 
});






  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Java', 'JavaScript', 'Python', 'Flutter',  'Graphics Design','Digital Marketing', 'HTML, CSS & XML',],
      datasets: [{
        label: 'Skill Rating',
        data: [60, 60, 70, 60, 90, 80, 90,100],
        borderWidth: 2
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });



  const ct = document.getElementById('oluuka');

  new Chart(ct, {
    type: 'bar',
    data: {
      labels: [ 'Java', 'JavaScript', 'Python', 'Flutter',  'Graphics Design','Digital Marketing', 'HTML, CSS & XML',],
      datasets: [{
        label: 'Skill Rating',
        data: [80, 70, 80, 60, 70, 70, 90,100],
        borderWidth: 2
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });


  const cx = document.getElementById('lazarus');

  new Chart(cx, {
    type: 'bar',
    data: {
      labels: ['Java', 'JavaScript', 'Python',  'Graphics Design','Digital Marketing', 'Database mgt', 'HTML & CSS',],
      datasets: [{
        label: 'Skill Rating',
        data: [80, 20, 90, 50, 80, 50, 90,100],
        borderWidth: 2
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });





//live chat code
 