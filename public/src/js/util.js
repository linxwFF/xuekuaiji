var Util = function() {

    function isFunction(fn) {
      return (!!fn&&!fn.nodename&&fn.constructor!=String&&fn.constructor!=RegExp&&fn.constructor!=Array&&/function/i.test(fn+""));
    }

    // ajax 辅助函数
    var ajaxHelper = function (url, type, data, successDeal, errorDeal) {
          var result = {};
          $.ajax({
            url: url,
            type: type,
            data: data,
            async : false,
            dataType: "json",
            success: function(response, textStatus, xhr) {
              result.status = xhr.status;
              result.is_true = true;
              result.data = xhr.responseJSON;
              if (isFunction(successDeal)) {
                successDeal();
              };
            },
            error: function(xhr, textStatus, error) {
              result.status = xhr.status;
              result.is_true = false;
              result.data = xhr.responseJSON;
              if (isFunction(errorDeal)) {
                errorDeal();
              };
            }
          });
          return result;
    };

    var notify = function (message, type){
        layer.msg(message, {icon: type});
    }

    return {
        ajaxHelper : ajaxHelper,
        notify : notify,
    };

}();
