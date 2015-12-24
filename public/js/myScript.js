$(function() {
  // flash_messageフェードアウト
  setTimeout(function() {
    $('#flash_message').fadeOut("slow");
  }, 500);

  // 権限作成バリデーション
  $('#roleSubmit').click(function() {
    $(this).attr('disabled', 'disabled');
    $('#role #nameErr').remove();
    var error = false;
    var name = $('#role input[name="name"]').val();
    if (name.length == 0) {
      $('#role input[name="name"]').parent().after('<p id="nameErr" class="alert alert-danger">権限名は入力必須です。</p>');
      error = true;
    }
    if (error == false) {
      $('#roleForm').submit();
    }
    $(this).removeAttr('disabled');
  });
  // 権限のダイアログを閉じたときの処理
  $('#role').on('hidden.bs.modal', function () {
    $('#role input[name="name"]').val('');
    $('#role #nameErr').remove();
  });

  // カテゴリー作成バリデーション
  $('#categorySubmit').click(function() {
    $(this).attr('disabled', 'disabled');
    $('#category #nameErr').remove();
    var error = false;
    var name = $('#category input[name="name"]').val();
    if (name.length == 0) {
      $('#category input[name="name"]').parent().after('<p id="nameErr" class="alert alert-danger">カテゴリー名は入力必須です。</p>');
      error = true;
    }
    if (error == false) {
      $('#categoryForm').submit();
    }
    $(this).removeAttr('disabled');
  });
  // カテゴリーのダイアログを閉じたときの処理
  $('#category').on('hidden.bs.modal', function () {
    $('#category input[name="name"]').val('');
    $('#category #nameErr').remove();
  });
});
