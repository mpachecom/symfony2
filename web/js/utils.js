function getExtension(filename) {
    var parts = filename.split('.');
    ext = parts[parts.length - 1];

    return ext.toLowerCase();
}

function isCsv(filename){
    if (getExtension(filename) == "csv"){
        return true;
    }else{
        return false;
    }
}