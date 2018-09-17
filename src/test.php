<?php
	require_once('SentimentAnalyzer.php');	
	$sat = new SentimentAnalyzerTest(new SentimentAnalyzer());

	$sat->trainAnalyzer('../trainingSet/data.neg', 'negative', 5000); //training with negative data
	$sat->trainAnalyzer('../trainingSet/data.pos', 'positive', 5000); //trainign with positive data

		$sentence1 = 'while the performances are often engaging , this loose collection of largely improvised numbers would probably have worked better as a one-hour tv documentary . ';
		$sentence2 = 'edited and shot with a syncopated style mimicking the work of his subjects , pray turns the idea of the documentary on its head , making it rousing , invigorating fun lacking any mtv puffery . 
';

		$sentimentAnalysisOfSentence1 = $sat->analyzeSentence($sentence1);

		$resultofAnalyzingSentence1 = $sentimentAnalysisOfSentence1['sentiment'];
		$probabilityofSentence1BeingPositive = $sentimentAnalysisOfSentence1['accuracy']['positivity'];
		$probabilityofSentence1BeingNegative = $sentimentAnalysisOfSentence1['accuracy']['negativity'];

		$sentimentAnalysisOfSentence2 = $sat->analyzeSentence($sentence2);

		$resultofAnalyzingSentence2 = $sentimentAnalysisOfSentence2['sentiment'];
		$probabilityofSentence2BeingPositive = $sentimentAnalysisOfSentence2['accuracy']['positivity'];
		$probabilityofSentence2BeingNegative = $sentimentAnalysisOfSentence2['accuracy']['negativity'];
		$documentLocation = '../trainingSet/review.txt';
		$sentimentAnalysisOfDocument = $sat->analyzeDocument($documentLocation);
		$resultofAnalyzingDocument = $sentimentAnalysisOfDocument['sentiment'];
		$probabilityofDocumentBeingPositive = $sentimentAnalysisOfDocument['accuracy']['positivity'];
		$probabilityofDocumentBeingNegative = $sentimentAnalysisOfDocument['accuracy']['negativity'];

?>
