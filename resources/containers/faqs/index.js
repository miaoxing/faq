import faqItem from '../../templates/faq-item.ejs';

export default class FaqIndex {
  render() {
    const $list = $('.js-faq-list').list({
      url: $.url('faqs.json'),
      template: faqItem,
      localData: wei.faqs
    });

    $list.on('click', '.js-faq-link', function () {
      const $item = $(this).closest('.js-faq-item');
      $item.find('.js-faq-angel').toggleClass('answer-open');

      const $answer = $item.find('.js-faq-answer');
      $answer.toggle();
      if ($answer.is(':visible')) {
        $.post($.url('faqs/%s/view.json', $(this).data('id')));
      }
    });
  }
}
