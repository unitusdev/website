<?php
	require_once('include/header.php');
?>
    <!-- Technology Section -->
    <section id="technology" class="container content-section technology">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>Core Technology</h1>
			</div>
        </div>
        <div class="row">
			<div class="col-md-8 col-md-offset-2">
				<img src="images/technology.jpg" class="img-responsive center-block" />
			</div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-justify">
				<p>
					At it's core, Unitus is based on Bitcoin. This provides the proven and tested blockchain technology that is now used by the leading crypto currencies. 
					But whilst Bitcoin led this new era, it is not without it's share of issues. Relying on a single algorithm (SHA256d) has led to an arms race in mining hardware, 
					resulting now in an eco-system where only those willing to invest significant capital can mine Bitcoin on a profitable basis - and only then if a very cheap source of power can be utilised. 
					This has now caused significant centralisation of mining resources - effectively concentrating the direction and power of the Bitcoin network within a few large players, 
					i.e. the complete opposite of what Bitcoin was intended to be.
				</p>
				<p>
					By enhancing the Bitcoin codebase and adding support for multiple mining algorithms, and ensuring those algorithms can be mined by a range of hardware, 
					the balance of power is now restored. Each algorithm has an equal chance, so an arms race in one mining algorithm does not cause complete centralisation of the mining power. 
					New miners can enter the game using only a CPU if so desired, still with a chance of profitable mining. Multi-Algo was pioneered by Huntercoin, 
					refined and extended by <a href="http://myriadcoin.org/">Myriad</a>, and now used within several leading crypto-currencies.
				</p>
				<p>
					Add to this merge mining, and we further enhance the resiliency of the network. Merge mining allows a miner to mine a parent coin, whilst at the same time contribute network hashrate to 
					Unitus - and earn both the parent coin's mining rewards and Unitus at the same time, with no additional effort, cost or overhead on the miner's behalf. 
					This results in Unitus having zero environmental impact (as a result of not requiring any additional power being used to mine), whilst providing additional profit for the miner. 
					Merge Mining, or AuxPoW (Auxillary Proof of Work), was pioneered by Namecoin, saw greater adoption by the likes of Dogecoin and Syscoin. 
					Unitus was the first crypto-currency to combine Multi-Algo with Merge Mining to bring a more secure and resilient blockchain to reality.
				</p>
				<p>
					With a target block time of 60 seconds, the network facilitates fast transaction times and confirmations (as opposed to Bitcoin's 10 minute target time), and additionally supports a 
					larger number of transactions per second, ensuring the blockchain can support high transaction volume without significant cost to users.
				</p>
            </div>
        </div>
    </section>

    <!-- Algorithms Section -->
    <section id="algorithms" class="container content-section algorithms">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>Algorithms</h1>
				<h3>Unitus uses 5 independant algorithms to ensure the blockchain remains secure and can be mined by anyone, regardless of the hardware they have available to them.</h3>
				<img src="images/algo.jpg" class="img-responsive center-block" />
            </div>
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="row">
					<div class="col-md-4">
						<div class="well algo-well">
							<img src="images/chain_unitus_black.png" class="img-responsive center-block">
							<h4>Lyra2RE2</h4>
							<p>
								Lyra2RE2 is a chained algorithm with the unique use of Lyra2 password hashing algorithm. Developed for use within Vertcoin as a method of fighting off ASIC's. 
								Lyra2RE2 is mineable using CPU or GPU. Typical speed is 6MH/s with a NVidia 750ti.
							</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="well algo-well">
							<img src="images/chain_unitus_black.png" class="img-responsive center-block">
							<h4>Argon2d</h4>
							<p>
								Replacing Qubit from 3rd June 2017, Argon2d is one of the Argon2 password hashing algorithms that won the <a href="https://password-hashing.net/" target="_blank">Password Hashing Competition</a> in 2015.
								Designed to be resilient to ASIC and GPU attacks, it is optimised for Intel and AMD processors. The parameters we use within Unitus (specifically a 4MB memory cost) set it apart from all
								other cryptocurrencies that have previously used Argon2. The authors of Argon2 recommended increased memory utilisation, to further complicate any ASIC or GPU implementation of the algortihm.
							</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="well algo-well">
							<img src="images/chain_unitus_black.png" class="img-responsive center-block">
							<h4>Skein</h4>
							<p>
								The Skein hash was a finalist in the NIST hash function competition. It was created by was created by Bruce Schneier, Niels Ferguson, Stefan Lucks, Doug Whiting, Mihir Bellare, 
								Tadayoshi Kohno, Jon Callas and Jesse Walker. Skein was first used in Skeincoin, and is now also used in Myriad, Digibyte &amp; Auroracoin. 
								Skein is mineable using CPU or GPU, with best performance being seen from AMD GPU's.
							</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-md-offset-2">
						<div class="well algo-well">
							<img src="images/chain_unitus_black.png" class="img-responsive center-block">
							<h4>Yescrypt</h4>
							<p>
								Yescrypt is a CPU-only algorithm designed by Alexander Peslyak - better known as Solar Designer - the author of the widely popular security audit tool John the Ripper. 
								Yescrypt is an evolution of the Scrypt hashing algorithm, but designed to be hostile to even GPU mining, due to it's complexity and built-in defences. 
								It was first used in GlobalBoost-Y, and is now also used within Myriad. Yescrypt is only mineable with a CPU.
							</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="well algo-well">
							<img src="images/chain_unitus_black.png" class="img-responsive center-block">
							<h4>X11</h4>
							<p>
								The X11 hashing algorithm was invented for use within Dash. It uses 11 rounds of scientific hashing functions (blake, bmw, groestl, jh, keccak, skein, luffa, cubehash, shavite, simd, echo). 
								X11 is mineable using CPU or GPU, with good support for both AMD and NVidia GPU's. Since the advent of X11 ASIC's, X11 can now only be profitably mined with these newer generation ASIC's.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>
<?php	
	require_once('include/footer.php');
?>