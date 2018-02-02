const assert = require('assert');

/*
 * Mocha
 */
describe('Mocha', function() {
    it('arrow function', () => {
        // This method will be counted
        assert.equal(true, true);
    });

    it('function', function() {
        // This method will be counted
        assert.equal(true, true);
    });

    it("double quotes", () => {
        // This method will be counted
        assert.equal(true, true);
    });
});

/*
 * Jasmine
 */
describe('Jasmine', () => {
    it('arrow function', done => {
        // This method will be counted
        assert.equal(true, true);
    });

    it('function', function(done) {
        // This method will be counted
        assert.equal(true, true);
    });

    it("double quotes", done => {
        // This method will be counted
        assert.equal(true, true);
    });
});

/*
 * Jest
 */
describe('Jest', function() {
    it('arrow function', () => {
        // This method will be counted
        assert.equal(true, true);
    });
});

/*
 * Ava
 */
test('Ava', t => {
    // This method will be counted
    t.is(true, true);
});

test('Ava', function(t) {
    // This method will be counted
    t.is(true, true);
});

/*
 * Tape
 */
test('Tape', t => {
    // This method will be counted
    t.equal(true, true);
});

test('Tape', function(t) {
    // This method will be counted
    t.equal(true, true);
});

/*
 * QUnit
 */
QUnit.test('QUnit', function(assert) {
    assert.ok(true, 'true succeeds');
});


function thisFunctionShouldNotMakeItToTheCount() {
    // This function should not be counted
}

function doYouKnowIt() {
    // This function should not be counted
}

function thisIsATest() {
    // This function should not be counted
}
