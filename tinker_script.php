$p = User::where('login', 'teste1')->first();
$p->active = true;
$p->save();
$q = User::where('login', 'teste2')->first();
$q->active = true;
$q->save();
exit;