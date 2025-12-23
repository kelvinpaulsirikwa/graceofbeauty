// Wait for DOM to be ready
document.addEventListener('DOMContentLoaded', function() {

// SIDEBAR DROPDOWN
const allDropdown = document.querySelectorAll('#sidebar .side-dropdown');
const sidebar = document.getElementById('sidebar');

allDropdown.forEach(item=> {
	const a = item.parentElement.querySelector('a:first-child');
	a.addEventListener('click', function (e) {
		e.preventDefault();

		if(!this.classList.contains('active')) {
			allDropdown.forEach(i=> {
				const aLink = i.parentElement.querySelector('a:first-child');

				aLink.classList.remove('active');
				i.classList.remove('show');
			})
		}

		this.classList.toggle('active');
		item.classList.toggle('show');
	})
})





// SIDEBAR COLLAPSE
const toggleSidebar = document.querySelector('nav .toggle-sidebar');
const allSideDivider = document.querySelectorAll('#sidebar .divider');

// Check if mobile device
function isMobile() {
	return window.innerWidth <= 768;
}

// Initialize sidebar state
if(sidebar.classList.contains('hide')) {
	allSideDivider.forEach(item=> {
		item.textContent = '-'
	})
	allDropdown.forEach(item=> {
		const a = item.parentElement.querySelector('a:first-child');
		a.classList.remove('active');
		item.classList.remove('show');
	})
} else {
	allSideDivider.forEach(item=> {
		item.textContent = item.dataset.text;
	})
}

// Mobile: Toggle sidebar show/hide
// Desktop: Toggle sidebar hide/expand
toggleSidebar.addEventListener('click', function () {
	if(isMobile()) {
		// On mobile, toggle show class
		sidebar.classList.toggle('show');
		// Prevent body scroll when sidebar is open
		if(sidebar.classList.contains('show')) {
			document.body.classList.add('sidebar-open');
		} else {
			document.body.classList.remove('sidebar-open');
		}
	} else {
		// On desktop, toggle hide class
		sidebar.classList.toggle('hide');

		if(sidebar.classList.contains('hide')) {
			allSideDivider.forEach(item=> {
				item.textContent = '-'
			})

			allDropdown.forEach(item=> {
				const a = item.parentElement.querySelector('a:first-child');
				a.classList.remove('active');
				item.classList.remove('show');
			})
		} else {
			allSideDivider.forEach(item=> {
				item.textContent = item.dataset.text;
			})
		}
	}
})

// Close sidebar when clicking overlay or outside on mobile
document.addEventListener('click', function(e) {
	const sidebarOverlay = document.querySelector('.sidebar-overlay');
	
	if(isMobile() && sidebar.classList.contains('show')) {
		// If clicking on overlay
		if(sidebarOverlay && sidebarOverlay.contains(e.target)) {
			sidebar.classList.remove('show');
			document.body.classList.remove('sidebar-open');
			return;
		}
		
		// If clicking outside sidebar and not on toggle button
		if(!sidebar.contains(e.target) && !toggleSidebar.contains(e.target)) {
			sidebar.classList.remove('show');
			document.body.classList.remove('sidebar-open');
		}
	}
})

// Handle window resize
window.addEventListener('resize', function() {
	if(!isMobile()) {
		// On desktop, remove show class if it exists
		sidebar.classList.remove('show');
		document.body.classList.remove('sidebar-open');
	} else {
		// On mobile, ensure sidebar is hidden by default if not showing
		if(!sidebar.classList.contains('show')) {
			sidebar.classList.add('hide');
		}
	}
})




sidebar.addEventListener('mouseleave', function () {
	if(this.classList.contains('hide')) {
		allDropdown.forEach(item=> {
			const a = item.parentElement.querySelector('a:first-child');
			a.classList.remove('active');
			item.classList.remove('show');
		})
		allSideDivider.forEach(item=> {
			item.textContent = '-'
		})
	}
})



sidebar.addEventListener('mouseenter', function () {
	if(this.classList.contains('hide')) {
		allDropdown.forEach(item=> {
			const a = item.parentElement.querySelector('a:first-child');
			a.classList.remove('active');
			item.classList.remove('show');
		})
		allSideDivider.forEach(item=> {
			item.textContent = item.dataset.text;
		})
	}
})




// PROFILE DROPDOWN
const profile = document.querySelector('nav .profile');
const imgProfile = profile.querySelector('img');
const dropdownProfile = profile.querySelector('.profile-link');

imgProfile.addEventListener('click', function () {
	dropdownProfile.classList.toggle('show');
})




// MENU
const allMenu = document.querySelectorAll('main .content-data .head .menu');

allMenu.forEach(item=> {
	const icon = item.querySelector('.icon');
	const menuLink = item.querySelector('.menu-link');

	icon.addEventListener('click', function () {
		menuLink.classList.toggle('show');
	})
})



window.addEventListener('click', function (e) {
	if(e.target !== imgProfile) {
		if(e.target !== dropdownProfile) {
			if(dropdownProfile.classList.contains('show')) {
				dropdownProfile.classList.remove('show');
			}
		}
	}

	allMenu.forEach(item=> {
		const icon = item.querySelector('.icon');
		const menuLink = item.querySelector('.menu-link');

		if(e.target !== icon) {
			if(e.target !== menuLink) {
				if (menuLink.classList.contains('show')) {
					menuLink.classList.remove('show')
				}
			}
		}
	})
})





// PROGRESSBAR
const allProgress = document.querySelectorAll('main .card .progress');

allProgress.forEach(item=> {
	item.style.setProperty('--value', item.dataset.value)
})






// APEXCHART
var options = {
  series: [{
  name: 'series1',
  data: [31, 40, 28, 51, 42, 109, 100]
}, {
  name: 'series2',
  data: [11, 32, 45, 32, 34, 52, 41]
}],
  chart: {
  height: 350,
  type: 'area'
},
dataLabels: {
  enabled: false
},
stroke: {
  curve: 'smooth'
},
xaxis: {
  type: 'datetime',
  categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
},
tooltip: {
  x: {
    format: 'dd/MM/yy HH:mm'
  },
},
};

var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();

}); // End DOMContentLoaded