const SEARCH_FORM = '#search-form';

$(SEARCH_FORM).on('submit', searchDeviceHandler);

async function searchDeviceHandler(event){
    event.preventDefault();

    let form = event.target;
    console.log($(form).find('input[name=keywords]').val());
}