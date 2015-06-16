;$(function(){

  var index;

  updateForm();


  function updateForm(index) {
    $collectionHolder = $('ul.userAddresses');
    var $userAddressesLis = $collectionHolder.find('li.userAddress');
    var numAddr = $userAddressesLis.length;


    index = index || numAddr - 1;

    if (numAddr > 1) {
      $userAddressesLis.each(function() {
        addFormDeleteLink($(this), index);
      });
    }

    if (numAddr === 1) {
      $userAddressesLis.find('a.remove').remove();
    }

    addFormAddLink($userAddressesLis.last(), $collectionHolder, index);

  }

  function addFormAddLink($userAddressLi, $collectionHolder, index) {
    if (!$userAddressLi.find('a.add').length) {
      var $addFormLink = $('<a href="#" class="btn btn-sm btn-primary add"><i class="glyphicon glyphicon-plus"></i></a>');

      $userAddressLi.find('div.addressButtons').append($addFormLink);

      $addFormLink.on('click', function(e){
        e.preventDefault();

        $(this).remove();

        addUserAddressForm($collectionHolder, index);
      });
    }
  }

  function addFormDeleteLink($userAddressLi, index) {
    var $removeFormLink = $('<a href="#" class="btn btn-sm btn-primary remove"><i class="glyphicon glyphicon-minus"></i></a>');

    //if no remove button exist in this address li
    if (!$userAddressLi.find('a.remove').length) {
      $userAddressLi.find('div.addressButtons').append($removeFormLink);

      $removeFormLink.on('click', function(e) {
        e.preventDefault();
        $userAddressLi.remove();

        updateForm(index);
      });
    }
  }

  function addUserAddressForm($collectionHolder, index) {
    var prototype = $collectionHolder.data('prototype');

    var index = index + 1;

    var newForm = prototype.replace(/__name__/g, index);

    var newForm = $.parseHTML($.trim(newForm));

    var params = $(newForm).find('div.form-group');

    

    var $newZip = $('<div class="col-md-2 zip"></div>').append(params[0]);

    var $newCity = $('<div class="col-md-4 city"></div>').append(params[1]);

    var $newAddress = $('<div class="col-md-4 address"></div>').append(params[2]);

    var $newButtons = $('<div class="col-md-2 addressButtons"></div>');

    var $newForm = $('<div class="row"></div>').append($newZip)
                                               .append($newCity)
                                               .append($newAddress)
                                               .append($newButtons)
    ;

    var $userAddressLi = $('<li class="userAddress"></li>').append($newForm);

    $collectionHolder.append($userAddressLi);

    updateForm(index);
  }

});