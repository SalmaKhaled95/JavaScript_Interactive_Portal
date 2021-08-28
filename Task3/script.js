"use strict";
let tasks = [];

const getPriorityName = function (priority) {
  switch (priority) {
    case "1":
      return "High";
    case "2":
      return "Medium";
    case "3":
      return "Low";
    default:
      return "";
  }
};

const deleteTask = function (i) {
  if (!confirm("Are you sure ?")) return;
  tasks.splice(i, 1);
  renderTable();
};

const EDITABLE = function (i) {
    tasks[i].edit = 1;
    renderTable();

}


const saveTask = function (i) {

    const mytextbox = document.querySelector("#TEXTBOX").value;
    const priority = document.querySelector("#task_priority2").value;

    if ((mytextbox == "" && confirm("Empty Text Box!")) || (mytextbox != "")) {
        tasks.splice(i, 1, 'edited');
        tasks[i] = {
            name: mytextbox,
            priority: priority,
            edit: 0
        };
        renderTable();
    }
};



const cancelTask = function (i) {
    tasks[i].edit = 0;
    renderTable();
};

const moveUp = function (i) {
  if (i == 0) return;
  const oldTask = tasks[i];
  tasks[i] = tasks[i - 1];
  tasks[i - 1] = oldTask;
  renderTable();
};
const moveDown = function (i) {
  if (i == tasks.length - 1) return;
  const oldTask = tasks[i];
  tasks[i] = tasks[i + 1];
  tasks[i + 1] = oldTask;
  renderTable();
};


const renderTable = function () {
  const tbody = document.querySelector("#tasks_tbody");
  tbody.innerHTML = "";
    tasks.forEach((t, i) => {
        const row = `
        <tr>
        <td>${i + 1}</td>
        <td>
 
${t.edit == 1
                ? `<input type="text" id="TEXTBOX" class="form-control" placeholder=${ t.name } />`
                : `${t.name}`
            }
</td>
       
        <td>
${t.edit == 1
            ? `<select id="task_priority2" class="form-control">
                    <option value="1">High</option>
                    <option value="2">Medium</option>
                    <option value="3">Low</option>`
: `${getPriorityName(t.priority) }`


    }

</td>
        <td>
        ${i > 0
                ? `<button class="btn btn-sm btn-secondary" onclick="moveUp(${i})">Up</button>`
                : ``
            }
        ${i < tasks.length - 1
                ? `<button class="btn btn-sm btn-secondary" onclick="moveDown(${i})">Down</button>`
                : ``
            }
        </td>
        <td id= "lastone">
        ${t.edit == 0
            ? `<button class="btn btn-primary btn-sm" onclick="EDITABLE(${i})" width="2px" >Edit</button>`
            : `<button class="btn btn-primary btn-sm"  style="display:none;" width="2px">Edit</button>`
         }
 

${
            t.edit == 1
            ? `  <button class="btn btn-success btn-sm"  id="one" onclick="saveTask(${i})" width="2px" >Save</button>
                 <button class="btn btn-success btn-sm" id="two" onclick="cancelTask(${i})" width="2px">Cancel</button> 
                 <button class="btn btn-danger btn-sm" id ="deleteButton" onclick="deleteTask(${i})" width="2px">Delete</button> `
            : `  <button class="btn btn-success btn-sm" id="three" style="display:none;" width="2px" > Save</button>
                 <button class="btn btn-success btn-sm" id="four" style="display:none;" width="2px">Cancel</button>  
                 <button class="btn btn-danger btn-sm" id ="deleteButton" onclick="deleteTask(${i})"  width="2px">Delete</button> `
}


        
         
       
</td>
        </tr>
        `;
    tbody.insertAdjacentHTML("beforeEnd", row);
  });
};




const addTask = function () {
  console.log(this);
  const taskName = document.querySelector("#task_name").value;
  const priority = document.querySelector("#task_priority").value;
  if (taskName !== "" && priority > 0) {
    tasks.push({
      name: taskName,
        priority: priority,
        edit: 0
    });
    renderTable();
  }
};

document.querySelector("#add").addEventListener("click", addTask);
var name = "Test3";
var age = 22;
const calcFunction = () => {
  console.log(this);
  console.log(`My name is ${this.name} I'm ${this.age} years old`);
};
const obj = {
  name: "Test",
  age: 35,
  cal: calcFunction,
};

const obj2 = {
  name: "Test2",
  age: 22,
  cal: calcFunction,
};

function thisTest() {
  let obj1 = "Ramy";
  var obj2 = "Ahmed";
  console.log(this);
  const x = () => {
    console.log(this);
  };
  x();
}
