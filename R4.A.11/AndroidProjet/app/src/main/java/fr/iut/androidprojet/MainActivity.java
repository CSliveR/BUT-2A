package fr.iut.androidprojet;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class MainActivity extends MotherActivity {
    private Button createAccountBtn;
    private Button useAccountBtn;
    private Button seeAccountBtn;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        createAccountBtn = findViewById(R.id.button_createAccount);
        useAccountBtn = findViewById(R.id.button_useAccount);
        seeAccountBtn = findViewById(R.id.button_seeAccounts);

        createAccountBtn.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                Intent addUserActivityIntent = new Intent(MainActivity.this, AddUserActivity.class);
                startActivity(addUserActivityIntent);
                finish();
            }
        });

        useAccountBtn.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                Intent loginActivityIntent = new Intent(MainActivity.this, LoginActivity.class);
                startActivity(loginActivityIntent);
                finish();
            }
        });

        seeAccountBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent accountActivityIntent = new Intent(MainActivity.this, AccountActivity.class);
                startActivity(accountActivityIntent);
                finish();
            }
        });
    }
}