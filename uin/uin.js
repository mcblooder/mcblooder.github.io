var docno_attempts = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 1]
  , docno_attempts25 = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 1, 2, 3, 4, 5, 6]
  , inn_attempts_penult = [7, 2, 4, 10, 3, 5, 9, 4, 6, 8]
  , inn_attempts_last = [3, 7, 2, 4, 10, 3, 5, 9, 4, 6, 8]
  , snils_attempts = [9, 8, 7, 6, 5, 4, 3, 2, 1]
  , inn_check_number = 11
  , docno_check_number = 11
  , docno_last_rank = 19
  , docno_last_rank25 = 24
  , snils_last_rank = 9
  , inn_n2_rank = 10
  , inn_n1_rank = 11
  , inn_length = 12
  , docno_length = 20
  , docno_length25 = 25
  , snils_length = 11;

function calcCheckSum(d, a, f, b) {
    var g = 0;
    var c = a;
    for (var e = 0; e < b; e++) {
        g += f[c] * d[e];
        c++
    }
    return g
}

function splitDocNo(c) {
    var e, d;
    if (c.length == docno_length) {
        e = docno_last_rank;
        d = docno_attempts
    } else {
        return 'Заполните все поля'
    }
    var b = 0
      , a = calcCheckSum(c, b, d, e) % docno_check_number;
    if (a == 10 && b == 0) {
        b = 2;
        a = calcCheckSum(c, b, d, e) % docno_check_number
    }
    if (a == 10 && b == 2) {
        a = 0
    }
    return c.substr(0, 19) + a;
}

function getFormData($form){
  var unindexed_array = $form.serializeArray();
  var indexed_array = {};

  $.map(unindexed_array, function(n, i){
      indexed_array[n['name']] = n['value'];
  });

  return indexed_array;
}

function gen() {
  var formObject = getFormData($('#uinForm'));
  var kbk = formObject['kbk'];
  var gos = formObject['gos'];
  var paymentType = formObject['paymentType'];
  var docType = formObject['docType'];
  var region = formObject['region'];
  var year = formObject['year'];
  var month = formObject['month'];
  var day = formObject['day'];
  var number = formObject['number'];
  var uin = `${kbk}${gos}${paymentType}${docType}${region}${year}${month}${day}${number}`;
  var generatedUin = splitDocNo(uin + '#');
  if (generatedUin.length == 20) {
    $('#checkSum').val(generatedUin.substr(-1));
  }
  $('#output').val(generatedUin);
}
