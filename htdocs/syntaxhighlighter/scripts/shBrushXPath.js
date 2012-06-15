SyntaxHighlighter.brushes.Custom = function()
{
  this.regexList = [
      { regex: new RegExp('[a-zA-Z]+(?=[/\[])', 'gmi'),            css: 'string' },
      { regex: new RegExp('[a-zA-Z]+$', 'gmi'),            css: 'string' },
      { regex: new RegExp('@[a-zA-Z]+', 'gmi'),                css: 'value' },
      { regex: new RegExp('/(?!/)', 'gmi'),            css: 'keyword' },
      { regex: new RegExp('//', 'gmi'),            css: 'keyword color2' },
      { regex: new RegExp('[\[\]]', 'gmi'),            css: 'keyword color3' }
      ];
};
SyntaxHighlighter.brushes.Custom.prototype = new SyntaxHighlighter.Highlighter();
SyntaxHighlighter.brushes.Custom.aliases  = ['xpath'];