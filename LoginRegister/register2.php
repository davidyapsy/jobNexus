<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <title>Job Nexus | Register</title>
        <link rel="icon" type="image/x-icon" href="..\Pic/JobNexus_Logo.png">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <style>
            .topnav{
                background-color: white;
                overflow: hidden;
            }
            .topnav a {
                float: left;
                color: black;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
                font-size: 17px;
            }
            .topnav a:hover {
               color: #BABBDE;
            }
            .btn{
                background-color: #BABBDE;
            }
            .btn:hover{
                background-color: #b0b1d1;
            }
            #skillsList {
                margin-top: 10px;
            }
            .skillItem {
                margin-bottom: 5px;
                display: flex;
                align-items: center;
            }
            .skillText {
                flex-grow: 1;
                margin-right: 10px;
            }
            .removeSkill {
                background-color: #d9534f;
                color: white;
                border: none;
                width: 30px;
                height: 30px;
                cursor: pointer;
            }
            #addSkillButton{
                background-color: #BABBDE;
                color: white;
                border: none;
                width: 30px;
                height: 30px;
                cursor: pointer;
                margin-top: 5px;
            }
            #addSkillButton:hover{
                background-color: #b0b1d1;
            }
        </style>
    </head>
    
    <body style="background-color:#dfe2e6;">
        <div class="topnav">
            <a href="..\index.php"><h5>Job Nexus</h5></a>
        </div>
        
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-lg-8 mt-4">
                    <div class="card text-black" style="border-radius: 30px;">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-xl-10 order-2 order-lg-1">

                                    <p class="text-center h2 fw-bold mb-1">Register</p>
                                    <p class="text-center">Please enter your information</p>

                                    <form class="mx-md-1" action="..\registerFunctions.php" method="post">
                                        <label class="h5 fw-bold">Skills</label>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div class="profileDisplay flex-fill w-100">
                                                <input type="text" id="skills" class="form-control" name="skills" placeholder="Enter your skills and press 'enter' or the '+' button below">
                                                <button id="addSkillButton" type="button">Add Skill</button>
                                                <div id="skillsList"></div>
                                                
                                                <!-- Hidden input to store skills for form submission -->
                                                <input type="hidden" id="hiddenSkills" name="hiddenSkills" value="">
                                            </div>
                                        </div>
                                        
                                        <label class="h5 fw-bold">Working Years</label>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div class="profileDisplay flex-fill">
                                                <input type="number" id="wYears" class="form-control" name="wYears" placeholder="eg: 4" min="0" max="60">
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center">
                                            <input type="submit" id="submitButton" name="next2" class="submit btn col-4" value="Next">
                                        </div>
                                    </form>
                                    
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                        const skillsInput = document.getElementById("skills");
                                        const hiddenSkillsInput = document.getElementById("hiddenSkills");
                                        const addSkillButton = document.getElementById("addSkillButton");
                                        const skillsList = document.getElementById("skillsList");
                                        const wYearsInput = document.getElementById("wYears");
                                        const submitButton = document.getElementById("submitButton");
                                        const userSkills = [];

                                        function updateSkillsDisplay() {
                                            skillsList.innerHTML = '';
                                            userSkills.forEach(function(skill, index) {
                                                const skillItem = document.createElement("div");
                                                skillItem.className = "skillItem";
                                                const skillText = document.createElement("div");
                                                skillText.className = "skillText";
                                                skillText.textContent = skill;
                                                skillItem.appendChild(skillText);
                                                const removeButton = document.createElement("button");
                                                removeButton.className = "removeSkill";
                                                removeButton.setAttribute("data-index", index);
                                                removeButton.textContent = "x";
                                                skillItem.appendChild(removeButton);
                                                skillsList.appendChild(skillItem);
                                            });

                                            // Update the hidden input value
                                            hiddenSkillsInput.value = JSON.stringify(userSkills);
                                        }

                                        addSkillButton.addEventListener("click", function() {
                                            const skill = skillsInput.value.trim();
                                            if (skill) {
                                                userSkills.push(skill);
                                                updateSkillsDisplay();
                                                skillsInput.value = '';
                                            }
                                        });

                                        skillsList.addEventListener("click", function(event) {
                                            if (event.target.classList.contains("removeSkill")) {
                                                const index = event.target.getAttribute("data-index");
                                                userSkills.splice(index, 1);
                                                updateSkillsDisplay();
                                            }
                                        });

                                        document.addEventListener("keydown", function(event) {
                                            if (event.key === "Enter") {
                                                // Check if the skills input field is focused
                                                if (document.activeElement === skillsInput) {
                                                    event.preventDefault();
                                                    const skill = skillsInput.value.trim();
                                                    if (skill) {
                                                        userSkills.push(skill);
                                                        updateSkillsDisplay();
                                                        skillsInput.value = '';
                                                    }
                                                } else if (document.activeElement === wYearsInput) {
                                                    // Trigger click event of the submit button
                                                    submitButton.click();
                                                }
                                            }
                                        });

                                        addSkillButton.textContent = "+";
                                    });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php

        ?>
    </body>
</html>
