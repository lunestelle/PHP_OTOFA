$(document).ready(function () {
  const currentUrl = new URL(window.location.href);
  const navLinks = $('.sidebar .nav-link');
  getUserRoleFromServer(function(userRole) {
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
            currentUrl.href.includes('edit_driver')) &&
          linkUrl.includes('drivers')
        ) ||
        (
          (currentUrl.href.includes('new_appointment') ||
            currentUrl.href.includes('edit_appointment') ||
            currentUrl.href.includes('view_appointment') || currentUrl.href.includes('renewal_of_franchise') || currentUrl.href.includes('new_franchise')) &&
            linkUrl.includes('appointments') && !linkUrl.includes('appointments_reports')
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
        ) ||
        (
          currentUrl.href.includes('appointments_reports') && 
          linkUrl.includes('appointments_reports')
        ) ||
        (
          currentUrl.href.includes('view_calculations') &&
          linkUrl.includes('maintenance_tracker') &&
          currentUrl.searchParams.has('year') &&
          currentUrl.searchParams.has('cin')
        ) ||
        (linkUrl.includes('maintenance_tracker') && currentUrl.href.includes(linkUrl)
        ) ||
  
        (userRole === 'admin' && currentUrl.href.includes('view_driver') && linkUrl.includes('operators')) ||
        (userRole === 'operator' && currentUrl.href.includes('view_driver') && linkUrl.includes('drivers'));
  
      if (isActive) {
        $(this).addClass('nav-link-active');
      } else {
        $(this).removeClass('nav-link-active');
      }
    });
  });
 
  const setActiveLink = (keyword, href) => {
    if (currentUrl.href.includes(keyword)) {
      $('.sidebar a[href="' + href + '"]').addClass('nav-link-active');
    } else if (currentUrl.href.includes(keyword) && keyword === 'appointments' && currentUrl.searchParams.has('startDate') && currentUrl.searchParams.has('endDate')) {
      // Check for 'appointments' with startDate and endDate
      $('.sidebar a[href="' + href + '"]').addClass('nav-link-active');
    }
  };

  setActiveLink('red_trike_info', 'dashboard');
  setActiveLink('blue_trike_info', 'dashboard');
  setActiveLink('yellow_trike_info', 'dashboard');
  setActiveLink('green_trike_info', 'dashboard');
  setActiveLink('tricycles?status=active', 'tricycles');
  setActiveLink('appointments?status=pending', 'appointments');
  // setActiveLink('appointments', 'appointments');
  setActiveLink('new_franchise', 'appointments');
  setActiveLink('edit_new_franchise', 'appointments');
  setActiveLink('renewal_of_franchise', 'appointments');
  setActiveLink('edit_renewal_of_franchise', 'appointments');
  setActiveLink('change_of_motorcycle', 'appointments');
  setActiveLink('edit_change_of_motorcycle', 'appointments');
  setActiveLink('transfer_of_ownership', 'appointments');
  setActiveLink('edit_transfer_of_ownership', 'appointments');
  setActiveLink('intent_of_transfer', 'appointments');
  setActiveLink('edit_intent_of_transfer', 'appointments');
  setActiveLink('ownership_transfer_from_deceased_owner', 'appointments');
  setActiveLink('edit_ownership_transfer_from_deceased_owner', 'appointments');

  function getUserRoleFromServer(callback) {
    $.ajax({
      url: 'get_user_role',
      method: 'GET',
      success: function(response) {
        // Handle the response, which should contain the user's role
        callback(response);
      }
    });
  }

  // $(document).ready(function () {
  //   getUserRoleFromServer(function(role) {
  //     console.log("User role: " + role);
  //   });
  // });
});