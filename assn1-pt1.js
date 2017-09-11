const _ = require("underscore") ;


var data = [
    {id:1, firstName:'John', lastName:'Smith'},
    {id:2, firstName:'Jane', lastName:'Smith'},
    {id:3, firstName:'John', lastName:'Doe'}
];

function lookupById(currId){
    // with the assumption every user should have a unique ID
    idsFound = _.findWhere(data, {id: currId});
    return idsFound;
}

function lookupByLastName(currLastName){
    idsFound = _.where(data, {lastName: currLastName});
    console.log(idsFound);
}

function updateById(currId, fName, lName){
    _.each(data, function(item){
       if(item.id === currId){
           item.firstName = fName;
           item.lastName = lName;
       }
    });
}

function getIds(currDataSet){
    return _.pluck(currDataSet, 'id');
}

function getFirstNames(currDataSet){
    return _.pluck(currDataSet, 'firstName');
}

function getLastNames(currDataSet){
    return _.pluck(currDataSet, 'lastName');
}

function addEmployee(fName, lName){
    // use pluck and max
    // Get the highest id employee
    var currHighest = _.max(data, function(data){ return data.id; });
    console.log('currHighest == ' + currHighest.id);
    var newId = currHighest.id + 1;
    console.log('newId == ' + newId);

    //var currList = JSON.parse(data);
    data.push({id: newId, firstName: fName, lastName: lName});
}


console.log(lookupById(2));
console.log(lookupById(23))
console.log(lookupByLastName("Doe"));
console.log(lookupByLastName("Smith"));
console.log(lookupByLastName("Coffas"));
console.log(addEmployee('William', 'Smith'));
console.log(lookupByLastName("Harris"));
console.log(getLastNames(data));
updateById(2, 'Lisa', 'Smith');
console.log(data);
