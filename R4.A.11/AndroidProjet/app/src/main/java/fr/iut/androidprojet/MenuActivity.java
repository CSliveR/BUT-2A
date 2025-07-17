package fr.iut.androidprojet;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;

import fr.iut.androidprojet.gamesActs.geography.FlagsGuesserActivity;
import fr.iut.androidprojet.gamesActs.math.MathActivity;
import fr.iut.androidprojet.gamesActs.pendu.PenduActivity;
import fr.iut.androidprojet.gamesActs.shifoumi.ShifoumiActivity;

public class MenuActivity extends MotherActivity {
    private ImageView shifoumiImg;
    private ImageView mathImg;
    private ImageView penduImg;
    private ImageView geographyImg;
    private Button statsButton;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_menu);
        shifoumiImg = findViewById(R.id.image_shifoumi);
        mathImg = findViewById(R.id.image_math);
        penduImg = findViewById(R.id.image_pendu);
        geographyImg = findViewById(R.id.image_geography);
        statsButton = findViewById(R.id.stats_button);

        shifoumiImg.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent shifoumiActivityIntent = new Intent(MenuActivity.this, ShifoumiActivity.class);
                startActivity(shifoumiActivityIntent);
            }
        });

        mathImg.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent mathActivityIntent = new Intent(MenuActivity.this, MathActivity.class);
                startActivity(mathActivityIntent);
            }
        });

        penduImg.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent penduActivityIntent = new Intent(MenuActivity.this, PenduActivity.class);
                startActivity(penduActivityIntent);
            }
        });

        geographyImg.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent paysActivityIntent = new Intent(MenuActivity.this, FlagsGuesserActivity.class);
                startActivity(paysActivityIntent);
            }
        });

        statsButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent statsActivityIntent = new Intent(MenuActivity.this, StatsActivity.class);
                startActivity(statsActivityIntent);
            }
        });
    }
}