## Laravel EmChecker (Euromillions checker)

This is a simple application that I made for myself that notifies me when there is a Euromillions withdrawal and given my last bet, if I had won something :). It uses a SqLite database to store the withdrawals and your bet hits.
When the moment of the next Euromillion Withdrawal kicks in, it sends a email message saying how many numbers you have correctly guessed. Doesn't tell how much you won (perhaps you can implement this?).
It uses a cron job to know to precise moment of the withdrawal (9:45 pm each Tuesday and Friday). 
Uses the [Fast Feed](http://fastfeed.github.io/) library to fetch the [RSS euromillions feed](https://www.jogossantacasa.pt/web/SCRss/) from the portuguese bet house Santa Casa da Misericordia.

