const searchModel = document.querySelector('#site-search')

if (searchModel) {
  searchModel.addEventListener('keydown', function(e) {
    if (e.keyCode === 13) {
      fetch('../api/api-search.php?search=' + this.value)
        .then(response => response.json())
        .then(searchvalue => {
          const phones = document.querySelectorAll('.product')
          phones.forEach(function(child){
            if(child.querySelector('.product-name').textContent.toLowerCase().includes(searchvalue.toLowerCase())){
              if(child.classList.contains('searchhidden')){
                child.classList.remove('searchhidden')
              }
            }else{
              if(!child.classList.contains('searchhidden')){
                child.classList.add('searchhidden')
              }
            }
          }) 
        });

      e.preventDefault();
    }
  })
}

var filterButton = document.querySelector('#filterbutton');

filterButton.addEventListener('click', function() {
    var checkboxes = document.querySelectorAll('.modelcheckbox');
    
    var criteria = {};
    checkboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
            if (!criteria[checkbox.name]) {
                criteria[checkbox.name] = [];
            }
            criteria[checkbox.name].push(checkbox.value);
        }
    });

    var phones = document.querySelectorAll('.product');

    phones.forEach(function(phone) {
        var modelvalues = phone.querySelectorAll('.modelvalues');
        var matches = true;
        modelvalues.forEach(function(modelvalue) {
          var values = modelvalue.textContent.split(' ');
          values[0] = values[0].slice(0, -1);
          if(values[0] == "CPU" || values[0] == "Size" || values[0] == "Category"){
            for(var i = 2; i < values.length; i++){
              values[1] = values[1] + ' ' + values[i];
            }
          }
          while(values.length > 2){
            values.pop();
          }
          for(var key in criteria){
            if(key == values[0]){
              if(key == 'Battery' || key == 'Price'){
                if(criteria[key].includes("all")){
                  continue;
                }else{
                  for(var i = 0; i < criteria[key].length; i++){
                    var flag = true;
                    var interval = criteria[key][i].split('-');
                    if(interval.length == 2){
                      interval[1] = interval[1].substring(0, 4);
                      if(!(interval[0] <= values[1] && interval[1] >= values[1])){
                        if(flag) matches = false;
                      }else{
                        matches = true;
                        flag = false;
                      }
                    }else{
                      interval[0] = interval[0].substring(0, 4);
                      if(interval[0] > values[1]){
                        if(flag) matches = false;
                      }else{
                        matches = true;
                        flag = false;
                      }
                    }
                  }
                }
              }else{
                if(criteria[key].includes("all")){
                    continue;
                }
                else if(!criteria[key].includes(values[1])){
                    matches = false;
                }
              }
            }
        }
        });
        if (matches){
            if(phone.classList.contains('filterhidden')){
                phone.classList.remove('filterhidden');
            }
        } else {
            if(!phone.classList.contains('filterhidden')){
                phone.classList.add('filterhidden');
            }
        }
    });

    var event = new KeyboardEvent('keydown', {
      'keyCode': 13
    });

    searchModel.dispatchEvent(event);
    
});