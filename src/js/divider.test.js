import divider from './divider.js';

// Describe the test and wrap it in a function.
it('divides down to the nearest integer.', () => {
  const result = divider(5, 2);

  // Jest uses matchers, like pretty much any other JavaScript testing framework.
  // They're designed to be easy to get at a glance;
  // here, you're expecting `result` to be 2.5.
  expect(result).toBe(2.5);
});