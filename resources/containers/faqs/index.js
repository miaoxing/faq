import React from "react";
import ReactDOM from "react-dom";
import styled from 'styled-components';

const Answer = styled.div`
  img {
    max-width: 100%;
  }
`;

export default class extends React.Component {
  componentDidMount() {
    const $list = $('.js-faq-list').list({
      url: $.url('faqs.json'),
      template: data => {
        const container = document.createElement('div');
        return ReactDOM.render(<li className="js-faq-item">
          <a href="javascript:;" className="js-faq-link list-item has-feedback" data-id={data.id}>
            <h4 className="list-heading">{data.question}</h4>
            <i className="js-faq-angel bm-angle-right list-feedback"/>
          </a>
          <Answer className="js-faq-answer list-body p-b p-r text-normal display-none"
            dangerouslySetInnerHTML={{__html: data.answer}}/>
        </li>, container);
      }
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

  render() {
    return <div>
      <form className="search-form" action="" method="get">
        <div className="border-all border-radius">
          <input className="search-input" name="q" defaultValue={$.req('q')} type="text"
            placeholder="请输入问题或答案搜索"/>
        </div>
        <button className="search-submit">
          <i className="text-muted ni ni-search"/>
        </button>
      </form>
      <ul className="js-faq-list list list-indented">
      </ul>
    </div>
  }
}
