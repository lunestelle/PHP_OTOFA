$(document).ready(function() {
  let currentUrl = new URL(window.location.href);
  let navLinks = $('.sidebar .nav-link');

  navLinks.each(function() {
    let linkUrl = $(this).attr('href');

    if (linkUrl.includes('taripa')) {
      if (currentUrl.href.includes(linkUrl)) {
        $(this).addClass('nav-link-active');
      } else {
        $(this).removeClass('nav-link-active');
      }
    } else {
      if (currentUrl.href.includes('new_tricycle') && linkUrl.includes('tricycles') || currentUrl.href.includes('edit_tricycle') && linkUrl.includes('tricycles') || currentUrl.href.includes('view_tricycle') && linkUrl.includes('tricycles') || currentUrl.href.includes('new_driver') && linkUrl.includes('drivers') || currentUrl.href.includes('view_driver') && linkUrl.includes('drivers') || currentUrl.href.includes('edit_driver') && linkUrl.includes('drivers') || currentUrl.href.includes('new_appointment') && linkUrl.includes('appointment') || currentUrl.href.includes('view_appointment') && linkUrl.includes('appointment') || currentUrl.href.includes('edit_appointment') && linkUrl.includes('appointment') || currentUrl.href.includes('new_taripa') && linkUrl.includes('taripa') || currentUrl.href.includes('new_maintenance_log') && linkUrl.includes('maintenance_logs') || currentUrl.href.includes('edit_maintenance_log') && linkUrl.includes('maintenance_logs') || currentUrl.href.includes('view_maintenance_log') && linkUrl.includes('maintenance_logs') || currentUrl.href.endsWith(linkUrl) || currentUrl.href.includes('view_operator') && linkUrl.includes('operators')) {
        $(this).addClass('nav-link-active');
      } else {
        $(this).removeClass('nav-link-active');
      }
    }
  });

  if (currentUrl.href.includes('red_trike_info')) {
    $('.sidebar a[href="dashboard"]').addClass('nav-link-active');
    return;
  } else if (currentUrl.href.includes('blue_trike_info')) {
    $('.sidebar a[href="dashboard"]').addClass('nav-link-active');
    return;
  } else if (currentUrl.href.includes('yellow_trike_info')) {
    $('.sidebar a[href="dashboard"]').addClass('nav-link-active');
    return;
  } else if (currentUrl.href.includes('green_trike_info')) {
    $('.sidebar a[href="dashboard"]').addClass('nav-link-active');
    return;
  } else if (currentUrl.href.includes('tricycles?status=active')) {
    $('.sidebar a[href="tricycles"]').addClass('nav-link-active');
    return;
  } else if (currentUrl.href.includes('appointments?status=pending')) {
    $('.sidebar a[href="appointments"]').addClass('nav-link-active');
    return;
  }
});

document.addEventListener('DOMContentLoaded', function() {
  let currentUrl = window.location.href;
  let isHome = currentUrl.endsWith('/');
  let navLinks = document.querySelectorAll('.nav-link');
  navLinks.forEach(function(link) {
    if ((link.getAttribute('href') === '#home' && isHome) || (link.getAttribute('href') === '#home' && !isHome && window.location.hash === '#home')) {
      link.classList.add('active');
    }
  });

  // Listen for hash changes and update the active class accordingly
  window.addEventListener('hashchange', function() {
    // Remove the 'active' class from all links
    navLinks.forEach(function(link) {
      link.classList.remove('active');
    });

    // Get the new anchor part of the URL
    let newAnchor = window.location.hash.substr(1);

    navLinks.forEach(function(link) {
      if (link.getAttribute('href') === '#' + newAnchor) {
        link.classList.add('active');
      }
    });
  });
});