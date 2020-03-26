export default function divider(dividend, divisor) {
    if (divisor === 0) {
      throw new Error('Division by zero.');
    }
    return dividend / divisor;
  }