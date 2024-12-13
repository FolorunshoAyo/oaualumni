<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/register', 'User::register');
//$routes->get('/new-user/', 'User::newUser');
$routes->get('/update-pofile', 'User::updateUser');
$routes->get('/send-email', 'User::sendEmail');
$routes->get('/login', 'User::login');
$routes->get('/contact', 'Pages::contact');
$routes->post('contact/send-message', 'Pages::userQuery');
$routes->get('/faq', 'Pages::faq');
$routes->get('/about', 'Pages::about');
$routes->get('/executives', 'Pages::executives');
$routes->get('/alumni', 'Pages::alumni');
$routes->get('/cashapp', 'Pages::cashapp');
$routes->post('/cashapp-payment', 'Pages::cashappPayment');
$routes->get('/interest-groups', 'InterestGroups::index');
$routes->get('/interest-group/read/(:segment)', 'InterestGroups::read/$1');
$routes->get('/interest-group/join/(:segment)', 'InterestGroups::joingroup/$1');
$routes->get('/donations', 'Donations::index');
$routes->get('/donation/read/(:segment)', 'Donations::read/$1');
$routes->post('/donate/(:segment)', 'Donations::donate/$1');
$routes->post('/donation/success', 'Donations::success');
$routes->get('/donation/cancel', 'Donations::cancel');
$routes->post('/donation/ipn', 'Donations::ipn');
$routes->get('/online-meetings', 'OnlineMeetings::index');
$routes->get('/online-meeting/read/(:segment)', 'OnlineMeetings::read/$1');
$routes->get('/online-meeting/join/(:segment)', 'OnlineMeetings::joinmeeting/$1');
$routes->get('/online-meeting/thank-you', 'OnlineMeetings::thankyou');


$routes->get('admin/new-news-and-event', 'Admin::newNewsEvents');
$routes->post('admin/add-news-and-event', 'Admin::addNewsEvents');
$routes->get('admin/all-news-and-events', 'Admin::allNewsEvents');
$routes->get('admin/edit-news-and-events/(:segment)', 'Admin::editNewsEvents/$1');
$routes->post('admin/update-news-and-event', 'Admin::updateNewsEvents');


$routes->get('/news', 'NewsEvents::index');
$routes->get('news/readnrews/(:segment)', 'NewsEvents::readnrews/$1');
$routes->get('events/read/(:segment)', 'NewsEvents::readevent/$1');
//$route['events/read/(:num)'] = 'newsEvents/readView/$1';
$routes->get('/events', 'NewsEvents::events');
$routes->get('/fetch-events', 'NewsEvents::fetchevents');
// $routes->get('events/read/(:segment)', 'NewsEvents::read/$1');


$routes->get('admin/new-about-section', 'Admin::newHomeSection');
$routes->post('admin/add-about-section', 'Admin::addHomeSection');
$routes->get('admin/all-about-sections', 'Admin::allHomeSection');
$routes->get('admin/edit-about-section/(:segment)', 'Admin::editHomeSection/$1');
$routes->post('admin/update-about-section', 'Admin::updateHomeSection');

$routes->get('admin/new-how-it-works', 'Admin::newHowWorks');
$routes->post('admin/add-how-it-works', 'Admin::addHowWorks');
$routes->get('admin/all-how-it-works', 'Admin::allHowWorks');
$routes->get('admin/edit-how-it-works/(:segment)', 'Admin::editHowWorks/$1');
$routes->get('admin/delete-how-it-works/(:num)', 'Admin::deleteHowWorks/$1');
$routes->post('admin/update-how-it-works', 'Admin::updateHowWorks');

$routes->get('admin/new-alumni', 'Admin::newAlumni');
$routes->post('admin/add-alumni', 'Admin::addAlumni');
$routes->get('admin/all-alumni', 'Admin::allAlumni');
$routes->get('admin/edit-alumni/(:segment)', 'Admin::editAlumni/$1');
$routes->post('admin/update-alumni', 'Admin::updateAlumni');
$routes->get('admin/delete-alumni/(:num)', 'Admin::deleteAlumni/$1');

$routes->get('admin/new-interest-group', 'Admin::newInterestGroup');
$routes->post('admin/add-interest-group', 'Admin::addInterestGroup');
$routes->get('admin/all-interest-groups', 'Admin::allInterestGroups');
$routes->get('admin/edit-interest-group/(:segment)', 'Admin::editInterestGroup/$1');
$routes->get('admin/view-group-members/(:segment)', 'Admin::viewInterestGroupMembers/$1');
$routes->get('admin/delete-interest-group-member/(:segment)/member/(:segment)', 'Admin::deleteInterestGroupMember/$1/$2');
$routes->post('admin/update-interest-group', 'Admin::updateInterestGroup');
$routes->get('admin/delete-interest-group/(:num)', 'Admin::deleteInterestGroup/$1');

$routes->get('admin/new-donation', 'Admin::newDonation');
$routes->post('admin/add-donation', 'Admin::addDonation');
$routes->get('admin/all-donation-causes', 'Admin::allDonations');
$routes->get('admin/edit-donation/(:segment)', 'Admin::editDonation/$1');
$routes->get('admin/view-contributors/(:segment)', 'Admin::viewAllContributions/$1');
$routes->post('admin/update-donation', 'Admin::updateDonation');
$routes->get('admin/delete-donation/(:num)', 'Admin::deleteDonation/$1');

$routes->get('admin/new-zoom-meeting', 'Admin::newZoomMeeting');
$routes->post('admin/add-zoom-meeting', 'Admin::addZoomMeeting');
$routes->get('admin/all-zoom-meetings', 'Admin::allZoomMeetings');
$routes->get('admin/edit-zoom-meeting/(:segment)', 'Admin::editZoomMeeting/$1');
$routes->post('admin/update-zoom-meeting', 'Admin::updateZoomMeeting');
$routes->get('admin/delete-zoom-meeting/(:num)', 'Admin::deleteZoomMeeting/$1');

$routes->get('admin/new-album', 'Admin::newAlbum');
$routes->post('admin/add-album', 'Admin::addAlbum');
$routes->get('admin/all-albums', 'Admin::allAlbums');
$routes->get('admin/edit-album/(:segment)', 'Admin::editAlbum/$1');
$routes->post('admin/update-album', 'Admin::updateAlbum');
$routes->get('admin/delete-album/(:num)', 'Admin::deleteAlbum/$1');


$routes->get('admin/new-gallery-images', 'Admin::newGalleryImage');
$routes->post('admin/add-gallery-images', 'Admin::uploadGalleryImages');
$routes->post('admin/upload-news-letter-files', 'Admin::UploadNewsLetterFiles');

//$route['admin/upload-news-letter-files'] = 'admin/UploadNewsLetterFiles';
$routes->get('admin/view-album-images', 'Admin::viewGalleryImages');
$routes->get('admin/delete-gallery-image/(:num)/(:any)', 'Admin::deleteGalleryImage/$1/$2');

$routes->get('/galleries', 'Pages::gallery');
$routes->get('/galleries/photos/(:segment)', 'Pages::galleryImages/$1');



$routes->get('admin/new-slider', 'Admin::newslider');
$routes->post('admin/add-slider', 'Admin::addslider');
$routes->get('admin/all-slider', 'Admin::allslider');
$routes->get('admin/edit-slider/(:segment)', 'Admin::editslider/$1');
$routes->post('admin/update-slider', 'Admin::updateslider');

$routes->get('admin/new-calendar', 'Admin::newCalendar');
$routes->post('admin/add-calendar', 'Admin::addCalendar');
$routes->get('admin/all-calendar', 'Admin::allCalendar');
$routes->get('admin/edit-calendar/(:segment)', 'Admin::editCalendar/$1');
$routes->post('admin/update-calendar', 'Admin::updateCalendar');
$routes->get('admin/delete-calendar/(:num)', 'Admin::deleteCalendar/$1');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
