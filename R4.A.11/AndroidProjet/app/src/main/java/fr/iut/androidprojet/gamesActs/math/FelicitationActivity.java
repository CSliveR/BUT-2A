package fr.iut.androidprojet.gamesActs.math;

import static android.content.Intent.FLAG_ACTIVITY_CLEAR_TASK;
import static android.content.Intent.FLAG_ACTIVITY_NEW_TASK;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import fr.iut.androidprojet.MenuActivity;
import fr.iut.androidprojet.MotherActivity;
import fr.iut.androidprojet.R;

public class FelicitationActivity extends MotherActivity {
    private Button autreOperationBtn;
    private Button autreExoBtn;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_felicitation);

        autreOperationBtn = findViewById(R.id.autreOperation_button);
        autreExoBtn = findViewById(R.id.backMenu_button);

        autreOperationBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent mathActivityIntent = new Intent(FelicitationActivity.this, MathActivity.class);
                mathActivityIntent.addFlags(FLAG_ACTIVITY_CLEAR_TASK | FLAG_ACTIVITY_NEW_TASK);
                startActivity(mathActivityIntent);
            }
        });

        autreExoBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent menuActivityIntent = new Intent(FelicitationActivity.this, MenuActivity.class);
                startActivity(menuActivityIntent);
                finish();
            }
        });
    }
}