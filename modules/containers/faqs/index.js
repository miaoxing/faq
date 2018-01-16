import template from 'lodash.template';

export default class FaqIndex {
  render() {
    var $list = $('.js-faq-list').list({
      url: $.url('faqs.json'),
      template: template($('.js-faq-item-tpl').html()),
      localData: wei.faqs
    });

    $list.on('click', '.js-faq-link', function () {
      var $item = $(this).closest('.js-faq-item');
      $item.find('.js-faq-angel').toggleClass('answer-open');

      var $answer = $item.find('.js-faq-answer');
      $answer.toggle();
      if ($answer.is(':visible')) {
        $.post($.url('faqs/%s/view.json', $(this).data('id')));
      }
    });
  }
}
