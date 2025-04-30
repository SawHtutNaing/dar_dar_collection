table -> form_name => id , name

table -> form_data=>  id, form_name_id , code_id , customer_name , quantity , remark , user_id  , status 1, 0 (order_confirm, cancel )

table -> codes => id , code_name

table => code_form => form_id , code_id

the flow is =>
user will create form ,
user will create code ,
user will attach form and code (many to many)
your will fill form_data
in form ui , select the code , input quantity customer_name and remark
then in ui flow ,
user will click the see the form list , and crud
in form edit , user will attach code
then when click the form
user will see the form_data list and make crud
when create form , => after create form ->the ui flow need to redirect to the form_data create section only ->no return to the back page


 ive me the  code file ,  migration file , ui file, routes file , and also the command to create that file , use livewire 3





qquantity ထည့်ရန်
form edit မှာ actions button များ responsive လုပ်ပေးပါ
select a code to add form data > code
form data for ... => jsut form_name
code attach column
code quantity available(မူရင်းရှိအရေအတွက်)/live  ကျန် (left)

order confirm =>cancel => ပြန်ဖျက်ပေးပါ


view data => data

form data reprot for ... => reprot for form_name

created_at => date


excel => column => cus , co , quantity ,date

raw => ok
softed => customer_name sorted
