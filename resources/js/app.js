require('./bootstrap');

import Editor from '@toast-ui/editor'
import 'codemirror/lib/codemirror.css';
import '@toast-ui/editor/dist/toastui-editor.css';

const editor = new Editor({
  el: document.querySelector('#editor'),
  height: '300px'
});

document.querySelector('#articleForm').addEventListener('submit', e => {
    e.preventDefault();
    document.querySelector('#body').value = editor.getMarkdown();
    e.target.submit();
  });