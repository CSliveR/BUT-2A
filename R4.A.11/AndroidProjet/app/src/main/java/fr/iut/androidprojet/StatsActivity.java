package fr.iut.androidprojet;

import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.Log;
import android.widget.TextView;

import fr.iut.androidprojet.db.User;

public class StatsActivity extends MotherActivity {
    private TextView additionScoreView, soustractionScoreView, multiplicationScoreView, divisionScoreView;
    private TextView shifoumiScoreView, penduScoreView, flagGuesserScoreView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_stats);

        shifoumiScoreView = findViewById(R.id.shifoumi_view);
        additionScoreView = findViewById(R.id.addition_view);
        soustractionScoreView = findViewById(R.id.soustraction_view);
        multiplicationScoreView = findViewById(R.id.multiplication_view);
        divisionScoreView = findViewById(R.id.division_view);
        penduScoreView = findViewById(R.id.pendu_view);
        flagGuesserScoreView = findViewById(R.id.flagGuesser_view);
    }

    @Override
    protected void onResume() {
        super.onResume();
        SharedPreferences sharedPreferences = getSharedPreferences("GameStats", MODE_PRIVATE);

        int shifoumiScore = sharedPreferences.getInt("SCORE_SHIFOUMI", 0);
        int additionScore = sharedPreferences.getInt("SCORE_ADDITION", 0);
        int soustractionScore = sharedPreferences.getInt("SCORE_SOUSTRACTION", 0);
        int multiplicationScore = sharedPreferences.getInt("SCORE_MULTIPLICATION", 0);
        int divisionScore = sharedPreferences.getInt("SCORE_DIVISION",0);
        int penduScore = sharedPreferences.getInt("SCORE_PENDU", 0);
        int flagsGuesserScore = sharedPreferences.getInt("SCORE_DRAPEAUX", 0);

        shifoumiScoreView.setText(String.valueOf(shifoumiScore));
        additionScoreView.setText(String.valueOf(additionScore));
        soustractionScoreView.setText(String.valueOf(soustractionScore));
        multiplicationScoreView.setText(String.valueOf(multiplicationScore));
        divisionScoreView.setText(String.valueOf(divisionScore));
        penduScoreView.setText(String.valueOf(penduScore));
        flagGuesserScoreView.setText(String.valueOf(flagsGuesserScore));
    }
}


