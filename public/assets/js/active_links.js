$(document).ready(function () {
  const currentUrl = new URL(window.location.href);
  const navLinks = $('.sidebar .nav-link');

  navLinks.each(function () {
    const linkUrl = $(this).attr('href');
    const isActive =
      (linkUrl.includes('taripa') && currentUrl.href.includes(linkUrl)) ||
      (
        (currentUrl.href.includes('new_tricycle') ||
          currentUrl.href.includes('edit_tricycle') ||
          currentUrl.href.includes('view_tricycle')) &&
        linkUrl.includes('tricycles')
      ) ||
      (
        (currentUrl.href.includes('new_driver') ||
          currentUrl.href.includes('edit_driver') ||
          currentUrl.href.includes('view_driver')) &&
        linkUrl.includes('drivers')
      ) ||
      (
        (currentUrl.href.includes('new_appointment') ||
          currentUrl.href.includes('edit_appointment') ||
          currentUrl.href.includes('view_appointment')) &&
        linkUrl.includes('appointment')
      ) ||
      (
        (currentUrl.href.includes('new_taripa')) &&
        linkUrl.includes('taripa')
      ) ||
      (
        (currentUrl.href.includes('new_maintenance_log') ||
          currentUrl.href.includes('edit_maintenance_log') ||
          currentUrl.href.includes('view_maintenance_log')) &&
        linkUrl.includes('maintenance_logs')
      ) ||
      currentUrl.href.endsWith(linkUrl) ||
      (
        currentUrl.href.includes('view_operator') &&
        linkUrl.includes('operators')
      );

    if (isActive) {
      $(this).addClass('nav-link-active');
    } else {
      $(this).removeClass('nav-link-active');
    }
  });

  const setActiveLink = (keyword, href) => {
    if (currentUrl.href.includes(keyword)) {
      $('.sidebar a[href="' + href + '"]').addClass('nav-link-active');
    }
  };

  setActiveLink('red_trike_info', 'dashboard');
  setActiveLink('blue_trike_info', 'dashboard');
  setActiveLink('yellow_trike_info', 'dashboard');
  setActiveLink('green_trike_info', 'dashboard');
  setActiveLink('tricycles?status=active', 'tricycles');
  setActiveLink('appointments?status=pending', 'appointments');
  setActiveLink('new_franchise', 'appointments');
  setActiveLink('edit_new_franchise', 'appointments');
  setActiveLink('renewal_of_franchise', 'appointments');
  setActiveLink('edit_renewal_of_franchise', 'appointments');
  setActiveLink('change_of_motorcycle', 'appointments');
  setActiveLink('edit_change_of_motorcycle', 'appointments');
  setActiveLink('transfer_of_ownership', 'appointments');
  setActiveLink('edit_transfer_of_ownership', 'appointments');
});