const { JSDOM } = require('jsdom');
const jquery = require('jquery');

const dom = new JSDOM(`
<!doctype html>
<html>
  <body>
    <button id="myButton"></button>
    <div id="popup"></div>
    <div id="popup-text"></div>
    <button id="popup-close"></button>
    <div id="scelte"></div>
    <div id="total"></div>
    <div class="conferma-squad">
      <button class="button-squad" name="conferma_squadra">Conferma Squadra</button>
    </div>
    <button class="botton_costo_scuderia" data-price="100" value="RedBull">100$</button>
    <!-- Add any other elements that fanta-formula.js interacts with -->
  </body>
</html>
`);
global.document = dom.window.document;
global.window = dom.window;
global.$ = jquery(dom.window);

let expect;
const handleClick = require('./../fanta-formula.js');

before(async () => {
    const chai = await import('chai');
    expect = chai.expect;
});

describe('handleClick', () => {
    let button, counterName, maxCount, parentDiv, totalElement, choicesElement;

    beforeEach(() => {
        counters = {
            piloti: 0,
            scuderie: 0
        };
        parentDiv = document.createElement('div');
        parentDiv.classList.add('disabled'); 
        totalElement = document.createElement('div');
        var total = 15000;
        totalElement.id = 'total';
        totalElement.textContent = "Budget disponibile: " + total + " $";
        document.body.appendChild(totalElement);
    
        button = document.createElement('button');
        button.setAttribute('data-price', '6900');
        button.value = 'RedBull';
        counterName = 'scuderie'; 
        maxCount = 1;  
        parentDiv.appendChild(button);

        choicesElement = document.createElement('div');
        choicesElement.id = 'choices';
        choicesElement.textContent = "Piloti: " + counters.piloti + "/2, Scuderie: " + counters.scuderie + "/1";
        document.body.appendChild(choicesElement);
    
        popup = document.createElement('div');
        document.body.appendChild(popup);
    });

    it('should increase total and decrease counter when parentDiv is disabled', () => {
        handleClick(button, counterName, maxCount);
        console.log(totalElement.textContent);
        console.log(choicesElement.textContent);
        //expect(totalElement.textContent).to.equal('Budget disponibile: 8100 $');
        //expect(choicesElement.textContent).to.equal('Piloti: 0/2, Scuderie: 1/1');
        expect(counters.scuderie).to.equal(1);
    });

    it('should not decrease total and increase counter when price is more than total', () => {
        button.setAttribute('data-price', '200');
        handleClick(button, counterName, maxCount);
        expect(totalElement.textContent).to.equal('Budget disponibile: 100 $');
        expect(choicesElement.textContent).to.equal('Piloti: 0/2, Scuderie: 0/1');
    });

    it('should not decrease total and increase counter when maxCount is reached', () => {
        parentDiv.classList.remove('disabled');
        handleClick(button, counterName, maxCount);
        handleClick(button, counterName, maxCount);
        handleClick(button, counterName, maxCount);
        expect(totalElement.textContent).to.equal('Budget disponibile: 0 $');
        expect(choicesElement.textContent).to.equal('Piloti: 2/2, Scuderie: 0/1');
    });

    it('should decrease total and increase counter when a new selection is made', () => {
        parentDiv.classList.remove('disabled');
        handleClick(button, counterName, maxCount);
        expect(totalElement.textContent).to.equal('Budget disponibile: 50 $');
        expect(choicesElement.textContent).to.equal('Piloti: 1/2, Scuderie: 0/1');
    });
});