function CombineMenu(menuSelector, combineMenuName) {
  if (!isCombine) {
    return;
  }
  var listMenuElement = document.querySelector(menuSelector);
  var menuGuests = listMenuElement.querySelectorAll('.menu-guest');
  menuGuests = Array.from(menuGuests);

  // Remove các item gốc
  menuGuests.forEach((item) => {
    item.remove()
  })

  // Lấy ra các content HTML của thẻ item menu
  menuGuests = menuGuests.map((item) => {
    return item.outerHTML;
  })

  var menuCombine = document.createElement('li');
  menuCombine.classList = 'nav-item menu-parent';

  var contentInMenuCombine = `<a href="#" class="nav-link" data-link="suplies">
        <p>
          ${combineMenuName}
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
      </ul>`;
  menuCombine.innerHTML = contentInMenuCombine;
  // Bọc các thẻ item menu vào bên trong menuCombine mới tạo
  menuCombine.querySelector('.nav-treeview').innerHTML = menuGuests.join('');
  listMenuElement.append(menuCombine);
}