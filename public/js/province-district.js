function getOptionProvince(provinces) {
  dfOption = '<option disabled selected value="">Select an option</option>';
  options = provinces.reduce(function (a, b) {
    return a + '<option value="' + b.id + '">' + b.name + '</option>';
  }, '');

  return dfOption + options;
}

function getOptionDistrict(districts) {
  dfOption = '<option disabled selected value="">Select an option</option>';
  options = districts.reduce(function (a, b) {
    return a + '<option value="' + b.id + '">' + b.name + '</option>';
  }, '');

  return dfOption + options;
}