function ActiveLink(listMenuSelector, options) {
  var menu = {}
  var listMenuElement = document.querySelector(listMenuSelector);

  // Đưa data vào menu
  var menuElements = listMenuElement.querySelectorAll(`[data-link]`);
  menuElements.forEach((item) => {
    let dataLink = item.getAttribute('data-link');
    menu[options[dataLink] || dataLink] = dataLink;
  })

  var url = url = new URL(window.location.href);
  var menu_name = url.pathname.split('/')[1];
  if (menu_name === '') {
    // console.log(listMenuElement.querySelector(`[data-link="home"]`))
    listMenuElement.querySelector(`[data-link="home"]`).classList.add('active');
    return;
  }
  
  var menu_active = listMenuElement.querySelector(`[data-link=${menu[menu_name]}]`);
  
  if (menu_active) {
    menu_active.classList.add('active');
    var menu_parent = menu_active.closest('.menu-parent');
    if (menu_parent) {
      menu_parent.querySelector('.nav-link').classList.add('active');
      menu_parent.classList.add('menu-open');
    }
  }
}