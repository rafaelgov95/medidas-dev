import { AppMedidasPage } from './app.po';

describe('app-medidas App', function() {
  let page: AppMedidasPage;

  beforeEach(() => {
    page = new AppMedidasPage();
  });

  it('should display message saying app works', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('app works!');
  });
});
