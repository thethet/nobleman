<?php

class CertController extends BaseController {
/**
* Display a listing of the resource.
*
* @return Response
*/
	protected $layout = "layouts.main";
	public function index()
	{
		if(Auth::user()->role ==1 ) {
		$this->layout->content =  View::make('cert.index');
		}//end
	}

	public function certificatelists()
	{
		if(Auth::user()->role ==1 ) {
		$certificate = CertIDEntry::get();
		$this->layout->content =  View::make('cert.createlists')->with('certificate',$certificate);
		}//end
	}

	public function create()
	{
		if (Auth::user()->role == 1) {
			$this->layout->content = View::make('cert.create');
		}//end if
	}

	public function storenewcertificate()
	{
		if (Auth::user()->role == 1) {
			$rules = array(
				'certname' => 'required',
				'certid' => 'required'
			);
			$validator = Validator::make(Input::all(), $rules);

			if ($validator->fails()) {
				return Redirect::to('cert/create')
					->withErrors($validator);
			} else {

				$CertIDEntry = new CertIDEntry;
				$CertIDEntry->name = Input::get('certname');
				$CertIDEntry->serial = Input::get('certid');
				
				date_default_timezone_set('Asia/Singapore');
				$date = date('Y-m-d h:i:s', time());
				$CertIDEntry->created_at = $date;
				$CertIDEntry->created_by = Auth::user()->show_id;
				$CertIDEntry->save();

				Session::flash('message', 'Successfully created Certificate!');
				return Redirect::to('cert/certificates');
			}
		
		}//end if
	}

	public function certificateview($id)
	{
		if(Auth::user()->role ==1 ) {
		$certificate = CertIDEntry::find($id);
		return View::make('cert.certificateedit')
			->with('certificate', $certificate);
		}//end
	}

	public function certificateedit()
	{
		if (Auth::user()->role == 1) {
			$id = Input::get('id');
			$rules = array(
				'certname' => 'required',
				'certid' => 'required'
			);
			$validator = Validator::make(Input::all(), $rules);

			if ($validator->fails()) {
				return Redirect::to('cert/certificates/' . $id)
					->withErrors($validator);
			} else {

				$CertIDEntry = CertIDEntry::find(Input::get('id'));
				$CertIDEntry->name = Input::get('certname');
				$CertIDEntry->serial = Input::get('certid');
				$CertIDEntry->save();
				Session::flash('message', 'Successfully updated Certificate!');
				return Redirect::to('cert/certificates');
			}
		
		}//end if
	}

	public function certificatedelete()
	{
		if(Auth::user()->role ==1 ) {
		$id = Input::get('id');
		CertIDEntry::find($id)->delete();
		return Redirect::to('cert/certificates');
		}//end
	}


	/*******************************************************************************/

	public function generatelists()
	{
		if(Auth::user()->role ==1 ) {
		$generatecert = CertEntry::get();
		$this->layout->content =  View::make('cert.generatecertlists')->with('generatecert',$generatecert);
		}//end
	}
	
	public function gcertcreate()
	{
		if (Auth::user()->role == 1) {
			$certificates = CertIDEntry::get();
			$courses = CoursesEntry::get();
			$student = StudentEntry::get();

			$issuers = User::where('role','!=','3')->get(); 
			$this->layout->content = View::make('cert.generatecertcreate')
									 ->with('certificates',$certificates)
									 ->with('courses',$courses)
									 ->with('student',$student)
									 ->with('issuers',$issuers);
		}//end if
	}

	public function gcertstore()
	{

		if (Auth::user()->role == 1) {
			$rules = array(
				'date' => 'required'
			);
			$validator = Validator::make(Input::all(), $rules);

			if ($validator->fails()) {
				return Redirect::to('cert/generatecert')
					->withErrors($validator);
			} else {

				$CertEntry = new CertEntry;
				$CertEntry->stdname = Input::get('stdname');
				$CertEntry->course = Input::get('course');
				$CertEntry->date = Input::get('date');
				$CertEntry->certid = Input::get('certcode');
				$CertEntry->created_by = Auth::user()->show_id;

				$CertEntry->issued_by = Input::get('issued_by');
				$CertEntry->collection_date = Input::get('collection_date');

				$CertEntry->save();

				$certid = Input::get('certcode');
				$cert_code = CertIDEntry::where('id','=',$certid)->pluck('serial');
				$stdname = Input::get('stdname');
				$sname = StudentEntry::where('id','=',$stdname)->pluck('name');
				$course = Input::get('course');
				$scourse = CoursesEntry::where('id','=',$course)->pluck('course_name');

				$date = Input::get('date'); 
				$issuer = User::find($CertEntry->issued_by)->show_id;

				$html=	'<html><head><style>body{ font-family:helvetica }</style></head><body>'
						.'<div>'
						.'<div style="padding-top:50px;text-align:center;">'
						.'<p style="font-size:15px;font-family:helvetica!important">Certificate No:'.$cert_code .'</p>'
						.'</div>'
						.'<div style="padding-top:30px;text-align:center">'
						.'<p style="font-size:18px;font-weight:400;font-family:helvetica!important">'.$sname .'</p>'
						.'</div>'
						.'<div style="padding-top:50px;text-align:center;line-height:0.5">'
						.'<p style="font-size:18px;font-family:helvetica!important">'.$scourse .'</p>'
						.'<p style="font-size:10px;font-family:helvetica!important">Certificate Issue Date:'.$date .'</p>'
						.'<p style="font-size:10px;font-family:helvetica!important">Certificate Collection Date:'.$CertEntry->collection_date .'</p>'
						.'</div>'
						.'<div style="padding-top:50px;text-align:center;line-height:0.5">'
						.'<p style="font-size:18px;font-family:helvetica!important">'.'Issued By' .'</p>'
						.'<p style="font-size:10px;font-family:helvetica!important">Certificate Issue Date:'.$issuer .'</p>'
						.'</div>'						
						.'</div>'
						.'</body>'
						.'</html>';
				PDF::load($html, 'A4', 'portrait')->download();

				//Session::flash('message', 'Successfully created Certificate!');
				return Redirect::to('cert/generatecertlists');
			}
		
		}//end if
	}

	public function gcertdelete()
	{
		if(Auth::user()->role ==1 ) {
		$id = Input::get('id');
		CertEntry::find($id)->delete();
		return Redirect::to('cert/generatecertlists');
		}//end
	}

	/*******************************************************************************/

	public function cert1()
	{
		if(Auth::user()->role ==1 ) {
		$cert1 = CertEntry::get();
		$certid = CertIDEntry::where('id','=','1')->pluck('serial');
		$module = CoursesEntry::get();
		$student = StudentEntry::get();
		$this->layout->content =  View::make('cert.cert1')->with('cert1',$cert1)->with('certid',$certid)->with('module',$module)->with('student',$student);
		}//end
	}
	public function save1()
	{
		if(Auth::user()->role ==1 ) {

		$rules = array(
			'date' => 'required'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('cert/cert1')
				->withErrors($validator);
		} else {

		$id = Input::get('id');
		$name = Input::get('name');
		$sname = StudentEntry::where('id','=',$name)->pluck('name');
		$module = Input::get('module');
		$smodule = CoursesEntry::where('id','=',$module)->pluck('module_name');
		$date = Input::get('date');
		$cert = new CertEntry;
		$cert->name = $name ;
		$cert->module = $smodule ;
		$cert->date = $date ;
		$cert->certid = $id ;
		$cert->save();
		$certid = CertIDEntry::find(1);
		$certid -> serial = $id+1;
		$certid->save();
		$html=	'<html><head><style>body{ font-family:helvetica }</style></head><body>'
				.'<div>'
				.'<div style="padding-top:180px;text-align:center;">'
				.'<p style="font-size:15px;font-family:helvetica!important">Certificate No:'.$id .'</p>'
				.'</div>'
				.'<div style="padding-top:30px;text-align:center">'
				.'<p style="font-size:18px;font-weight:400;font-family:helvetica!important">'.$sname .'</p>'
				.'</div>'
				.'<div style="padding-top:50px;text-align:center;line-height:0.5">'
				.'<p style="font-size:18px;font-family:helvetica!important">'.$smodule .'</p>'
				.'<p style="font-size:10px;font-family:helvetica!important">Certificate Issue Date:'.$date .'</p>'
				.'</div>'
				.'</div>'
				.'</body>'
				.'</html>';
		PDF::load($html, 'A4', 'portrait')->download();
		return Redirect::to('cert');
		}

		}//end
	}


	public function cert2()
	{
		if(Auth::user()->role ==1 ) {
		$cert2 = CertEntry::get();
		$certid = CertIDEntry::where('id','=','2')->pluck('serial');
		$module = CoursesEntry::get();
		$student = StudentEntry::get();
		$this->layout->content =  View::make('cert.cert2')->with('cert2',$cert2)->with('certid',$certid)->with('module',$module)->with('student',$student);
		}//end
	}
	public function save2()
	{
		if(Auth::user()->role ==1 ) {

		$rules = array(
			'date' => 'required'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('cert/cert2')
				->withErrors($validator);
		} else {
			$id = Input::get('id');
			$name = Input::get('name');
			$sname = StudentEntry::where('id','=',$name)->pluck('name');
			$module = Input::get('module');
			$smodule = CoursesEntry::where('id','=',$module)->pluck('module_name');
			$date = Input::get('date');
			$cert = new CertEntry;
			$cert-> name = $name ;
			$cert-> module = $smodule ;
			$cert-> date = $date ;
			$cert-> certid = $id ;
			$cert->save();
			$certid = CertIDEntry::find(3);
			$certid -> serial = $id+1;
			$certid->save();
			$html=	'<html><head><style>p{ font-family:helvetica!important }</style></head><body>'
					.'<div>'
					.'<div style="padding-top:180px;text-align:center;">'
					.'<p style="font-size:15px;font-family:helvetica!important">Certificate No:'.$id .'</p>'
					.'</div>'
					.'<div style="padding-top:30px;text-align:center">'
					.'<p style="font-size:18px;font-weight:400;font-family:helvetica!important">'.$sname .'</p>'
					.'</div>'
					.'<div style="padding-top:50px;text-align:center;line-height:0.5">'
					.'<p style="font-size:18px;font-family:helvetica!important">'.$smodule .'</p>'
					.'<p style="font-size:10px;font-family:helvetica!important">Certificate Issue Date:'.$date .'</p>'
					.'</div>'
					.'</div>'
					.'</body>'
					.'</html>';
			return PDF::load($html, 'A4', 'portrait')->show();

		}

		}//end
	}
	public function cert3()
	{
		if(Auth::user()->role ==1 ) {
		$cert3 = CertEntry::get();
		$certid = CertIDEntry::where('id','=','3')->pluck('serial');
		$module = CoursesEntry::get();
		$student = StudentEntry::get();
		$this->layout->content =  View::make('cert.cert3')->with('cert3',$cert3)->with('certid',$certid)->with('module',$module)->with('student',$student);
		}//end
	}
	public function save3()
	{
		if(Auth::user()->role ==1 ) {

		$rules = array(
			'date' => 'required'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('cert/cert3')
				->withErrors($validator);
		} else {
			$id = Input::get('id');
			$name = Input::get('name');
			$sname = StudentEntry::where('id','=',$name)->pluck('name');
			$module = Input::get('module');
			$smodule = CoursesEntry::where('id','=',$module)->pluck('module_name');
			$date = Input::get('date');
			$cert = new CertEntry;
			$cert->name = $name ;
			$cert->module = $smodule ;
			$cert->date = $date ;
			$cert->certid = $id ;
			$cert->save();
			$certid = CertIDEntry::find(3);
			$certid -> serial = $id+1;
			$certid->save();
			$html=	'<html><head><style>p{ font-family:helvetica!important }</style></head><body>'
					.'<div>'
					.'<div style="padding-top:180px;text-align:center;">'
					.'<p style="font-size:15px;font-family:helvetica!important">Certificate No:'.$id .'</p>'
					.'</div>'
					.'<div style="padding-top:30px;text-align:center">'
					.'<p style="font-size:18px;font-weight:400;font-family:helvetica!important">'.$sname .'</p>'
					.'</div>'
					.'<div style="padding-top:50px;text-align:center;line-height:0.5">'
					.'<p style="font-size:18px;font-family:helvetica!important">'.$smodule .'</p>'
					.'<p style="font-size:10px;font-family:helvetica!important">Certificate Issue Date:'.$date .'</p>'
					.'</div>'
					.'</div>'
					.'</body>'
					.'</html>';
			return PDF::load($html, 'A4', 'portrait')->show();
		}

		}//end
	}
	public function cert4()
	{
		if(Auth::user()->role ==1 ) {
		$cert4 = CertEntry::get();
		$certid = CertIDEntry::where('id','=','4')->pluck('serial');
		$module = CoursesEntry::get();
		$student = StudentEntry::get();
		$this->layout->content =  View::make('cert.cert4')->with('cert4',$cert4)->with('certid',$certid)->with('module',$module)->with('student',$student);
		}//end
	}
	public function save4()
	{
		if(Auth::user()->role ==1 ) {

		$rules = array(
			'date' => 'required'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('cert/cert3')
				->withErrors($validator);
		} else {
			$id = Input::get('id');
			$name = Input::get('name');
			$sname = StudentEntry::where('id','=',$name)->pluck('name');
			$module = Input::get('module');
			$smodule = CoursesEntry::where('id','=',$module)->pluck('module_name');
			$date = Input::get('date');
			$cert = new CertEntry;
			$cert-> name = $name ;
			$cert-> module = $smodule ;
			$cert-> date = $date ;
			$cert-> certid = $id ;
			$cert->save();
			$certid = CertIDEntry::find(4);
			$certid -> serial = $id+1;
			$certid->save();
			$html=	'<html><head><style>p{ font-family:helvetica!important }</style></head><body>'
					.'<div>'
					.'<div style="padding-top:180px;text-align:center;">'
					.'<p style="font-size:15px;font-family:helvetica!important">Certificate No:'.$id .'</p>'
					.'</div>'
					.'<div style="padding-top:30px;text-align:center">'
					.'<p style="font-size:18px;font-weight:400;font-family:helvetica!important">'.$sname .'</p>'
					.'</div>'
					.'<div style="padding-top:50px;text-align:center;line-height:0.5">'
					.'<p style="font-size:18px;font-family:helvetica!important">'.$smodule .'</p>'
					.'<p style="font-size:10px;font-family:helvetica!important">Certificate Issue Date:'.$date .'</p>'
					.'</div>'
					.'</div>'
					.'</body>'
					.'</html>';
			return PDF::load($html, 'A4', 'portrait')->show();
		}

		}//end
	}


	public function updateCertificateStatus($id)
	{
		$cert = CertEntry::find($id);
		$date = date('Y-m-d', time());
		/*$cert->update([
			'received_certificate'	=>	! $cert->received_certificate
		]);*/

		CertEntry::where('id', '=', $id)->update(array('received_date' => $date, 'received_certificate'	=>	! $cert->received_certificate));

		return Redirect::back();
	}


	function export()
	{
		if (Auth::user()->role == 1) {
			   header('Content-Encoding: UTF-8');
			   header("Content-type: application/vnd.ms-excel;charset=charset=UTF-8;");
			   header("Content-Disposition: attachment; filename=Certificate_Export_Data".date('d-m-Y_his').".csv");
			   header("Pragma: no-cache"); 
			   header("Expires: 0");

			   $data ='';
			   $line = '';
			   $header='';

			   $header='Student Name' . ",\t".'Certificate No.' . ",\t".'Course' . ",\t".'Issue Date'. ",\t".'Receive Certification'. ",\t".'Receive Date' .",\t";

			   $cert_query = DB::select("SELECT st.name,ci.serial,m.course_name,c.date,case c.received_certificate when '1' then 'Yes' when '0' then 'No' end,c.received_date FROM cert AS c LEFT JOIN students AS st ON c.stdname=st.id LEFT JOIN courses AS m ON c.course=m.id LEFT JOIN certid AS ci ON c.certid=ci.id");


			   foreach( $cert_query as $row )
				{
				    $line = '';
				    foreach( $row as $value )
				    {                                            
				        if ( ( !isset( $value ) ) || ( $value == "" ) )
				        {
				            //$value = "\t";
				            $value = str_replace( '"' , '""' , $value );
			            	$value = $value. ",\t";
				        }
				        else
				        {
				            $value = str_replace( '"' , '""' , $value );
                			$value = $value. ",\t";
				        }
				        $line .= $value;
				    }
				    $data .= trim(strip_tags($line)) . "\n";
				}
				$data = str_replace("\r" , "" , $data);

				
				//ob_end_clean();
				
			
	   			$csv_data= "$header\n$data";
				
				print $csv_data;
				exit;



		}//end
	}


	/* Download for each certificate */
	function download($id)
	{ 
		if (Auth::user()->role == 1) {
			$cert = CertEntry::find($id);			
			$cert_no = CertIDEntry::where('id','=',$cert['certid'])->pluck('serial');
			$sname = StudentEntry::where('id','=',$cert['stdname'])->pluck('name');
			$scourse = CoursesEntry::where('id','=',$cert['course'])->pluck('course_name');
			$date = $cert['date'];			

			$issuer = User::find($cert->issued_by) ? User::find($cert->issued_by) ->show_id : '';

			$html=	'<html><head><style>body{ font-family:helvetica }</style></head><body>'
					.'<div>'
					.'<div style="padding-top:50px;text-align:center;">'
					.'<p style="font-size:15px;font-family:helvetica!important">Certificate No:'.$cert_no .'</p>'
					.'</div>'
					.'<div style="padding-top:30px;text-align:center">'
					.'<p style="font-size:18px;font-weight:400;font-family:helvetica!important">'.$sname .'</p>'
					.'</div>'
					.'<div style="padding-top:50px;text-align:center;line-height:0.5">'
					.'<p style="font-size:18px;font-family:helvetica!important">'.$scourse .'</p>'
					//.'<p style="font-size:10px;font-family:helvetica!important">Certificate Issue Date:'.$date .'</p>'
					//.'<p style="font-size:10px;font-family:helvetica!important">Certificate Collection Date:'.$cert->collection_date .'</p>'
					.'</div>'
					.'<div style="padding-top:50px;text-align:center;line-height:0.5">'
					.'<p style="font-size:18px;font-family:helvetica!important">'.'Issued By' .'</p>'
					.'<p style="font-size:10px;font-family:helvetica!important">'.$issuer .'</p>'
					.'<p style="font-size:10px;font-family:helvetica!important">Certificate Issue Date:'.$date .'</p>'
					.'</div>'						
					.'</div>'
					.'</body>'
					.'</html>';
			PDF::load($html, 'A4', 'portrait')->download('Certificate_PDF');
			return Redirect::to('cert/generatecertlists');



		}//end
	}	

}
?>